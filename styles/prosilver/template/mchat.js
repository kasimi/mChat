/**
 *
 * @package mChat JavaScript Code mini
 * @version 1.4.4 of 2013-11-03
 * @copyright (c) 2009 By Shapoval Andrey Vladimirovich (AllCity) ~ http://allcity.net.ru/
 * @copyright (c) 2013 By Rich McGirr (RMcGirr83) http://rmcgirr83.org
 * @copyright (c) 2015 By dmzx - http://www.dmzx-web.net
 * @copyright (c) 2015 By kasimi
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 *
 */
if (!String.prototype.startsWith) {
	String.prototype.startsWith = function(searchString, position) {
		position = position || 0;
		return this.indexOf(searchString, position) === position;
	};
}

if (!String.prototype.capitalize) {
	String.prototype.capitalize = function() {
		return this.charAt(0).toUpperCase() + this.slice(1);
	};
}

// Support Opera
if (typeof document.hasFocus === 'undefined') {
	document.hasFocus = function() {
		return document.visibilityState == 'visible';
	};
}

jQuery(function($) {
	var ajaxOptions = {
		url: mChat.file,
		timeout: 10000,
		type: 'POST',
		beforeSend: mChat.pauseSession,
		complete: mChat.resetSession,
		error: function(xhr, textStatus, errorThrown) {
			if (xhr.status == 400) {
				alert(mChat.flood);
			} else if (xhr.status == 403) {
				alert(mChat.noAccess);
			} else if (xhr.status == 501) {
				alert(mChat.noMessageInput);
			} else if (typeof console !== 'undefined' && console.log) {
				console.log('AJAX error. status: ' + textStatus + ', message: ' + errorThrown);
			}
		}
	};

	var formatRemainingSessionTime = function(time) {
		return (new Date(time * 1000)).toUTCString().match(/(\d\d:\d\d:\d\d)/)[0];
	};

	$.extend(mChat, {
		clear: function() {
			if ($('#mchat-input').val() !== '') {
				if (confirm(mChat.clearConfirm)) {
					mChat.resetSession();
					$('#mchat-input').val('');
				}
				$('#mchat-input').focus();
			}
		},
		sound: function(file) {
			if (Cookies.get('mChatNoSound')) {
				return;
			}
			file = mChat.extUrl + 'sounds/' + file + '.swf';
			if (navigator.userAgent.match(/MSIE ([0-9]+)\./) || navigator.userAgent.match(/Trident\/7.0; rv 11.0/)) {
				$('#mchat-sound').html('<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0" height="0" width="0" type="application/x-shockwave-flash"><param name="movie" value="' + file + '"></object>');
			} else {
				$('#mchat-sound').html('<embed src="' + file + '" width="0" height="0" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash"></embed>');
			}
		},
		notice: function() {
			if (!document.hasFocus()) {
				$.titleAlert(mChat.newMessageAlert, {interval: 1000});
			}
		},
		toggle: function(name) {
			var $elem = $('#mchat-' + name);
			$elem.slideToggle(function() {
				var cookieName = 'mChatShow' + name.capitalize();
				if ($elem.is(':visible')) {
					Cookies.set(cookieName, 'yes');
				} else {
					Cookies.remove(cookieName);
				}
			});
		},
		add: function() {
			if (mChat.submitting) {
				return;
			}
			if ($('#mchat-input').val() === '') {
				return;
			}
			var messChars = $('#mchat-input').val().replace(/ /g, '');
			if (mChat.mssgLngth && messChars.length > mChat.mssgLngth) {
				alert(mChat.mssgLngthLong);
				return;
			}
			var $formElems = $('#' + form_name + ' :input[name]').filter(function(i, elem) {
				return !elem.name.startsWith('addbbcode');
			});
			$.ajax($.extend({}, ajaxOptions, {
				data: $formElems.serialize(),
				beforeSend: function() {
					$('#mchat-add').attr('disabled', 'disabled');
					mChat.pauseSession();
				},
				success: mChat.refresh,
				complete: function() {
					mChat.resetSession();
					$('#mchat-input').val('').focus();
					$('#mchat-add').removeAttr('disabled');
				}
			}));
		},
		edit: function() {
			var $messageContainer = $(this).closest('.mchat-message');
			var $message = mChat.confirmContainer.find('textarea').show().val($messageContainer.data('edit'));
			mChat.confirmContainer.find('p').text(mChat.editInfo);
			phpbb.confirm(mChat.confirmContainer, function() {
				$.ajax($.extend({}, ajaxOptions, {
					data: {
						mode: 'edit',
						message_id: $messageContainer.data('id'),
						message: $message.val()
					},
					success: function(json) {
						$messageContainer.fadeOut('slow', function() {
							$messageContainer.replaceWith($(json.edit).hide().fadeIn('slow'));
						});
					},
					complete: function() {
						mChat.resetSession();
						if (!mChat.archiveMode && !mChat.messageTop) {
							setTimeout(function() {
								$('#mchat-main').animate({scrollTop: $('#mchat-main')[0].scrollHeight}, 'slow', 'swing');
							}, 250);
						}
					}
				}));
			});
		},
		del: function() {
			var $messageContainer = $(this).closest('.mchat-message');
			mChat.confirmContainer.find('textarea').hide();
			mChat.confirmContainer.find('p').text(mChat.delConfirm);
			phpbb.confirm(mChat.confirmContainer, function() {
				$.ajax($.extend({}, ajaxOptions, {
					data: {
						mode: 'del',
						message_id: $messageContainer.data('id')
					},
					success: function(json) {
						if (json.del) {
							$messageContainer.fadeOut('slow', function() {
								$messageContainer.remove();
							});
							mChat.sound('del');
						}
					},
				}));
			});
		},
		refresh: function() {
			var firstLastSelector = mChat.messageTop ? ':first' : ':last';
			var id = $('#mchat-messages').children(firstLastSelector).data('id');
			$.ajax($.extend({}, ajaxOptions, {
				data: {
					mode: 'refresh',
					message_last_id: id
				},
				beforeSend: function() {
					$('#mchat-refresh-ok,#mchat-refresh-error,#mchat-refresh-paused').hide();
					$('#mchat-refresh-load').show();
				},
				success: function(json) {
					var $html = $(json.refresh);
					if ($html.length) {
						$('#mchat-no-messages').remove();
						$('#mchat-messages')[mChat.messageTop ? 'prepend' : 'append']($html.hide());
						$html.css('opacity', 0).slideDown('slow').animate({opacity: 1}, {queue: false, duration: 'slow'});
						$('#mchat-main').animate({scrollTop: mChat.messageTop ? 0 : $('#mchat-main')[0].scrollHeight}, 'slow');
						mChat.sound('add');
						mChat.notice();
					}
					setTimeout(function() {
						$('#mchat-refresh-load,#mchat-refresh-error,#mchat-refresh-paused').hide();
						$('#mchat-refresh-ok').show();
						$('#mchat-refresh-text').html(mChat.refreshYes);
					}, 250);
				},
				error: function() {
					$('#mchat-refresh-load,#mchat-refresh-ok,#mchat-refresh-paused').hide();
					$('#mchat-refresh-error').show();
					mChat.sound('error');
				}
			}));
		},
		whois: function() {
			$.ajax($.extend({}, ajaxOptions, {
				data: {
					mode: 'whois'
				},
				beforeSend: function() {
					if (mChat.customPage) {
						$('#mchat-refresh-pending').show();
						$('#mchat-refresh').hide();
					}
				},
				success: function(json) {
					$('#mchat-whois').replaceWith(json.whois);
					if (mChat.customPage) {
						setTimeout(function() {
							$('#mchat-refresh-pending').hide();
							$('#mchat-refresh').show();
						}, 250);
					}
				},
				error: function() {
					mChat.sound('error');
				},
				complete: function() {
					if ($('#mchat-userlist').length && (Cookies.get('mChatShowUserlist') || mChat.customPage)) {
						$('#mchat-userlist').css('display', 'block');
					}
				}
			}));
		},
		countDown: function() {
			mChat.sessionTime -= 1;
			var timeLeft = formatRemainingSessionTime(mChat.sessionTime);
			$('#mchat-session').html(mChat.sessEnds + ' ' + timeLeft);
			if (mChat.sessionTime <= 0) {
				mChat.endSession();
			}
		},
		pauseSession: function() {
			mChat.submitting = true;
			clearInterval(mChat.refreshInterval);
			if (mChat.userTimeout) {
				clearInterval(mChat.sessionCountdown);
			}
			if (mChat.whoisRefresh) {
				clearInterval(mChat.whoisInterval);
			}
		},
		resetSession: function() {
			clearInterval(mChat.refreshInterval);
			mChat.refreshInterval = setInterval(mChat.refresh, mChat.refreshTime);
			if (mChat.userTimeout) {
				mChat.sessionTime = mChat.userTimeout / 1000;
				clearInterval(mChat.sessionCountdown);
				mChat.sessionCountdown = setInterval(mChat.countDown, 1000);
				$('#mchat-session').html(mChat.sessEnds + ' ' + formatRemainingSessionTime(mChat.sessionTime));
			}
			if (mChat.whoisRefresh) {
				clearInterval(mChat.whoisInterval);
				mChat.whoisInterval = setInterval(mChat.whois, mChat.whoisRefresh);
			}
			$('#mchat-refresh-ok').show();
			$('#mchat-refresh-load,#mchat-refresh-error,#mchat-refresh-paused').hide();
			$('#mchat-refresh-text').html(mChat.refreshYes);
			mChat.submitting = false;
		},
		endSession: function() {
			clearInterval(mChat.refreshInterval);
			if (mChat.userTimeout) {
				clearInterval(mChat.sessionCountdown);
				$('#mchat-session').html(mChat.sessOut);
			}
			if (mChat.whoisRefresh) {
				clearInterval(mChat.whoisInterval);
			}
			$('#mchat-refresh-load,#mchat-refresh-ok,#mchat-refresh-error').hide();
			$('#mchat-refresh-paused').show();
			$('#mchat-refresh-text').html(mChat.refreshNo);
		},
		mention: function() {
			var $msg = $(this).closest('.mchat-message');
			var username = mChat.entityDecode($msg.data('username'));
			var usercolor = $msg.data('usercolor');
			if (usercolor) {
				username = '[b][color=' + usercolor + ']' + username + '[/color][/b]';
			} else if (mChat.allowBBCodes) {
				username = '[b]' + username + '[/b]';
			}
			insert_text('@ ' + username + ', ');
		},
		quote: function() {
			var $messageContainer = $(this).closest('.mchat-message');
			var username = mChat.entityDecode($messageContainer.data('username'));
			var quote = mChat.entityDecode($messageContainer.data('edit'));
			insert_text('[quote="' + username + '"] ' + quote + '[/quote]');
		},
		like: function() {
			var $msg = $(this).closest('.mchat-message');
			var username = mChat.entityDecode($msg.data('username'));
			var quote = mChat.entityDecode($msg.data('edit'));
			insert_text(mChat.likes + '[quote="' + username + '"] ' + quote + '[/quote]');
		},
		entityDecode: function(text) {
			var s = decodeURIComponent(text.replace(/\+/g, ' '));
			s = s.replace(/&lt;/g, '<');
			s = s.replace(/&gt;/g, '>');
			s = s.replace(/&#58;/g, ':');
			s = s.replace(/&#46;/g, '.');
			s = s.replace(/&amp;/g, '&');
			s = s.replace(/&quot;/g, "'");
			return s;
		}
	});

	if (!mChat.archiveMode) {
		$.fn.autoGrowInput = function() {
			this.filter('input:text').each(function() {
				var comfortZone = 20;
				var minWidth = $(this).width();
				var val = '';
				var input = $(this);
				var testSubject = $('<div>').css({
					position: 'absolute',
					top: -9999,
					left: -9999,
					width: 'auto',
					fontSize: input.css('fontSize'),
					fontFamily: input.css('fontFamily'),
					fontWeight: input.css('fontWeight'),
					letterSpacing: input.css('letterSpacing'),
					whiteSpace: 'nowrap'
				});
				testSubject.insertAfter(input);
				$(this).on('keypress blur change submit focus', function() {
					if (val === (val = input.val())) {
						return;
					}
					var escaped = val.replace(/&/g, '&amp;').replace(/\s/g, ' ').replace(/</g, '&lt;').replace(/>/g, '&gt;');
					var testerWidth = testSubject.html(escaped).width();
					var newWidth = (testerWidth + comfortZone) >= minWidth ? testerWidth + comfortZone : minWidth;
					if ((newWidth < input.width() && newWidth >= minWidth) || (newWidth > minWidth && newWidth < $('.mchat-panel').width() - comfortZone)) {
						input.width(newWidth);
					}
				});
			});
			return this;
		};

		mChat.resetSession();

		if (!mChat.messageTop) {
			$('#mchat-main').animate({scrollTop: $('#mchat-main')[0].scrollHeight}, 'slow', 'swing');
		}

		$('input#mchat-input').autoGrowInput();

		if (mChat.pause) {
			$('#mchat-input').on('keypress', mChat.endSession);
		}

		if (mChat.playSound && Cookies.get('mChatNoSound')) {
			$('#mchat-user-sound').removeAttr('checked');
		} else {
			Cookies.remove('mChatNoSound');
			$('#mchat-user-sound').attr('checked', 'checked');
		}

		$('#mchat-user-sound').change(function() {
			if (this.checked) {
				Cookies.remove('mChatNoSound');
			} else {
				Cookies.set('mChatNoSound', 'yes');
			}
		});

		$('#mchat-colour').html(phpbb.colorPalette('h', 15, 10)).on('click', 'a', function(e) {
			var color = $(this).data('color');
			bbfontstyle('[color=#' + color + ']', '[/color]');
			e.preventDefault();
		});

		if (Cookies.get('mChatShowSmilies')) {
			$('#mchat-smilies').slideToggle('slow');
		}

		if (Cookies.get('mChatShowBbcodes')) {
			$('#mchat-bbcodes').slideToggle('slow', function() {
				if (Cookies.get('mChatShowColour')) {
					$('#mchat-colour').slideToggle('slow');
				}
			});
		}

		if (Cookies.get('mChatShowUserlist') && $('#mchat-userlist').length || mChat.customPage) {
			$('#mchat-userlist').slideToggle('slow');
		}

		$('#postform').on('keypress', function(e) {
			if (e.which == 13) {
				mChat.add();
				e.preventDefault();
			}
		});
	}

	mChat.confirmContainer = $('#mchat-confirm').detach().show();

	$('#mchat-body').on('click', '[data-mchat-action]', function(e) {
		var action = $(this).data('mchat-action');
		mChat[action].call(this);
		e.preventDefault();
	});

	$('#mchat-body').on('click', '[data-mchat-toggle]', function(e) {
		var elem = $(this).data('mchat-toggle');
		mChat.toggle(elem);
		e.preventDefault();
	});
});
