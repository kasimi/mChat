/**
 *
 * @package mChat JavaScript Code mini
 * @version 1.5.0 of 2015-12-27
 * @copyright (c) 2009 By Shapoval Andrey Vladimirovich (AllCity) ~ http://allcity.net.ru/
 * @copyright (c) 2013 By Rich McGirr (RMcGirr83) http://rmcgirr83.org
 * @copyright (c) 2015 By dmzx - http://www.dmzx-web.net
 * @copyright (c) 2015 By kasimi
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 *
 */
// Support Opera
if (typeof document.hasFocus === 'undefined') {
	document.hasFocus = function() {
		return document.visibilityState == 'visible';
	};
}

jQuery(function($) {
	var ajaxRequest = function(mode, sendHiddenFields, data) {
		var deferred = $.Deferred();
		var promise = deferred.promise();
		if (sendHiddenFields) {
			mChat.hiddenFields.each(function() {
				data[this.name] = this.value;
			});
		}
		data.mode = mode;
		$.ajax({
			url: mChat.file,
			timeout: 10000,
			type: 'POST',
			data: data
		}).success(function(json, status, xhr) {
			if (json.hasOwnProperty(mode)) {
				deferred.resolve(json, status, xhr);
			} else {
				deferred.reject(xhr, status, 'rejected');
			}
		}).error(function(xhr, status, error) {
			deferred.reject(xhr, status, error);
		});
		return promise.fail(function(xhr, textStatus, errorThrown) {
			mChat.sound('error');
			mChat.$$('refresh-load', 'refresh-ok', 'refresh-paused').hide();
			mChat.$$('refresh-error').show();
			if (errorThrown == 'rejected') {
				alert(mChat.sessOut);
			} else if (xhr.status == 400) {
				alert(mChat.flood);
			} else if (xhr.status == 403) {
				alert(mChat.noAccess);
			} else if (xhr.status == 501) {
				alert(mChat.noMessageInput);
			} else if (typeof console !== 'undefined' && console.log) {
				console.log('AJAX error. status: ' + textStatus + ', message: ' + errorThrown);
			}
		});
	};

	$.extend(mChat, {
		clear: function() {
			if (mChat.$$('input').val() !== '') {
				if (confirm(mChat.clearConfirm)) {
					mChat.resetSession(true);
					mChat.$$('input').val('');
				}
				mChat.$$('input').focus();
			}
		},
		sound: function(file) {
			if (Cookies.get('mchat_no_sound')) {
				return;
			}
			file = mChat.extUrl + 'sounds/' + file + '.swf';
			if (navigator.userAgent.match(/MSIE ([0-9]+)\./) || navigator.userAgent.match(/Trident\/7.0; rv 11.0/)) {
				mChat.$$('sound').html('<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0" height="0" width="0" type="application/x-shockwave-flash"><param name="movie" value="' + file + '"></object>');
			} else {
				mChat.$$('sound').html('<embed src="' + file + '" width="0" height="0" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash"></embed>');
			}
		},
		notice: function() {
			if (!document.hasFocus()) {
				$.titleAlert(mChat.newMessageAlert, {interval: 1000});
			}
		},
		toggle: function(name) {
			var $elem = mChat.$$(name);
			$elem.stop().slideToggle(function() {
				var cookieName = 'mchat_show_' + name;
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
			if (mChat.$$('input').val() === '') {
				return;
			}
			var messChars = mChat.$$('input').val().replace(/ /g, '');
			if (mChat.mssgLngth && messChars.length > mChat.mssgLngth) {
				alert(mChat.mssgLngthLong);
				return;
			}
			mChat.$$('add').attr('disabled', 'disabled');
			mChat.pauseSession();
			ajaxRequest('add', true, {
				message: mChat.$$('input').val()
			}).done(function(json) {
				mChat.$$('input').val('');
				mChat.refresh();
				mChat.resetSession(false);
			}).always(function() {
				mChat.$$('input').focus();
				mChat.$$('add').removeAttr('disabled');
			});
		},
		edit: function() {
			var $container = $(this).closest('.mchat-message');
			var $message = mChat.$$('confirm').find('textarea').show().val($container.data('edit'));
			mChat.$$('confirm').find('p').text(mChat.editInfo);
			phpbb.confirm(mChat.$$('confirm'), function() {
				ajaxRequest('edit', true, {
					message_id: $container.data('id'),
					message: $message.val()
				}).done(function(json) {
					mChat.sound('edit');
					$container.fadeOut('slow', function() {
						$container.replaceWith($(json.edit).hide().fadeIn('slow'));
					});
					mChat.resetSession(true);
				});
			});
		},
		del: function() {
			var $container = $(this).closest('.mchat-message');
			mChat.$$('confirm').find('textarea').hide();
			mChat.$$('confirm').find('p').text(mChat.delConfirm);
			phpbb.confirm(mChat.$$('confirm'), function() {
				ajaxRequest('del', true, {
					message_id: $container.data('id')
				}).done(function(json) {
					mChat.sound('del');
					$container.fadeOut('slow', function() {
						$container.remove();
					});
					mChat.resetSession(true);
				});
			});
		},
		refresh: function() {
			var $messages = mChat.$$('messages').children();
			var editedMessages = {};
			$.each($messages, function() {
				var $message = $(this);
				var editTime = $message.data('edit-time');
				if (editTime) {
					editedMessages[$message.data('id')] = editTime;
				}
			});
			mChat.$$('refresh-ok', 'refresh-error', 'refresh-paused').hide();
			mChat.$$('refresh-load').show();
			ajaxRequest('refresh', false, {
				message_first_id: $messages.filter(mChat.messageTop ? ':last' : ':first').data('id'),
				message_last_id: $messages.filter(mChat.messageTop ? ':first' : ':last').data('id'),
				message_edits: editedMessages
			}).done(function(json) {
				var $html = $(json.refresh);
				if ($html.length) {
					mChat.$$('no-messages').remove();
					mChat.$$('messages')[mChat.messageTop ? 'prepend' : 'append']($html.hide());
					$html.css('opacity', 0).slideDown('slow').animate({opacity: 1}, {queue: false, duration: 'slow'});
					mChat.$$('main').animate({scrollTop: mChat.messageTop ? 0 : mChat.$$('main')[0].scrollHeight}, 'slow');
					mChat.sound('add');
					mChat.notice();
				}
				if (json.hasOwnProperty('edit')) {
					$.each(json.edit, function(id, content) {
						mChat.sound('edit');
						var $container = $('#mchat-message-' + id);
						$container.fadeOut('slow', function() {
							$container.replaceWith($(content).hide().fadeIn('slow'));
						});
					});
				}
				setTimeout(function() {
					if (mChat.refreshInterval) {
						mChat.$$('refresh-load', 'refresh-error', 'refresh-paused').hide();
						mChat.$$('refresh-ok').show();
					}
				}, 250);
			});
		},
		whois: function() {
			if (mChat.customPage) {
				mChat.$$('refresh-pending').show();
				mChat.$$('refresh').hide();
			}
			ajaxRequest('whois', false, {}).done(function(json) {
				var $whois = $(json.whois);
				var $userlist = $whois.find('#mchat-userlist');
				if (Cookies.get('mchat_show_userlist')) {
					$userlist.show();
				}
				mChat.$$('whois').replaceWith($whois);
				mChat.cache.whois = $whois;
				mChat.cache.userlist = $userlist;
				if (mChat.customPage) {
					setTimeout(function() {
						mChat.$$('refresh-pending').hide();
						mChat.$$('refresh').show();
					}, 250);
				}
			});
		},
		clean: function() {
			mChat.$$('confirm').find('textarea').hide();
			mChat.$$('confirm').find('p').text(mChat.cleanConfirm);
			phpbb.confirm(mChat.$$('confirm'), function() {
				ajaxRequest('clean', true, {}).done(function() {
					phpbb.alert('mChat', mChat.cleanDone);
					setTimeout(function() {
						location.reload();
					}, 1500);
				});
			});
		},
		timeLeft: function(sessionTime) {
			return (new Date(sessionTime * 1000)).toUTCString().match(/(\d\d:\d\d:\d\d)/)[0];
		},
		countDown: function() {
			mChat.sessionTime -= 1;
			mChat.$$('session').html(mChat.sessEnds + ' ' + mChat.timeLeft(mChat.sessionTime));
			if (mChat.sessionTime < 1) {
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
		resetSession: function(updateUi) {
			clearInterval(mChat.refreshInterval);
			mChat.refreshInterval = setInterval(mChat.refresh, mChat.refreshTime);
			if (mChat.userTimeout) {
				mChat.sessionTime = mChat.userTimeout / 1000;
				clearInterval(mChat.sessionCountdown);
				mChat.$$('session').html(mChat.sessEnds + ' ' + mChat.timeLeft(mChat.sessionTime));
				mChat.sessionCountdown = setInterval(mChat.countDown, 1000);
			}
			if (mChat.whoisRefresh) {
				clearInterval(mChat.whoisInterval);
				mChat.whoisInterval = setInterval(mChat.whois, mChat.whoisRefresh);
			}
			if (mChat.pause) {
				mChat.$$('input').one('keypress', mChat.endSession);
			}
			if (updateUi) {
				mChat.$$('refresh-ok').show();
				mChat.$$('refresh-load', 'refresh-error', 'refresh-paused').hide();
				mChat.$$('refresh-text').html(mChat.refreshYes);
			}
			mChat.submitting = false;
		},
		endSession: function() {
			clearInterval(mChat.refreshInterval);
			if (mChat.userTimeout) {
				clearInterval(mChat.sessionCountdown);
				mChat.$$('session').html(mChat.sessOut);
			}
			if (mChat.whoisRefresh) {
				clearInterval(mChat.whoisInterval);
				mChat.whois();
			}
			mChat.$$('refresh-load', 'refresh-ok', 'refresh-error').hide();
			mChat.$$('refresh-paused').show();
			mChat.$$('refresh-text').html(mChat.refreshNo);
		},
		mention: function() {
			var $container = $(this).closest('.mchat-message');
			var username = mChat.entityDecode($container.data('username'));
			var usercolor = $container.data('usercolor');
			if (usercolor) {
				username = '[b][color=' + usercolor + ']' + username + '[/color][/b]';
			} else if (mChat.allowBBCodes) {
				username = '[b]' + username + '[/b]';
			}
			insert_text('@ ' + username + ', ');
		},
		quote: function() {
			var $container = $(this).closest('.mchat-message');
			var username = mChat.entityDecode($container.data('username'));
			var quote = mChat.entityDecode($container.data('edit'));
			insert_text('[quote="' + username + '"] ' + quote + '[/quote]');
		},
		like: function() {
			var $container = $(this).closest('.mchat-message');
			var username = mChat.entityDecode($container.data('username'));
			var quote = mChat.entityDecode($container.data('edit'));
			insert_text(mChat.likes + '[quote="' + username + '"] ' + quote + '[/quote]');
		},
		entityDecode: function(text) {
			var s = decodeURIComponent(text.toString().replace(/\+/g, ' '));
			s = s.replace(/&lt;/g, '<');
			s = s.replace(/&gt;/g, '>');
			s = s.replace(/&#58;/g, ':');
			s = s.replace(/&#46;/g, '.');
			s = s.replace(/&amp;/g, '&');
			s = s.replace(/&quot;/g, "'");
			return s;
		},
		$$: function() {
			return $($.map(arguments, function(name) {
				if (!mChat.cache[name]) {
					mChat.cache[name] = $('#mchat-' + name);
				}
				return mChat.cache[name];
			})).map(function() {
				return this.toArray();
			});
		}
	});

	mChat.cache = {};
	mChat.$$('confirm').detach().show();
	mChat.hiddenFields = $('#' + form_name).find('input[type=hidden]');

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

		mChat.resetSession(true);

		if (!mChat.messageTop) {
			mChat.$$('main').animate({scrollTop: mChat.$$('main')[0].scrollHeight}, 'slow', 'swing');
		}

		if (!mChat.playSound || Cookies.get('mchat_no_sound')) {
			mChat.$$('user-sound').removeAttr('checked');
		} else {
			mChat.$$('user-sound').attr('checked', 'checked');
			Cookies.remove('mchat_no_sound');
		}

		if (Cookies.get('mchat_show_smilies')) {
			mChat.$$('smilies').slideToggle('slow');
		}

		if (Cookies.get('mchat_show_bbcodes')) {
			mChat.$$('bbcodes').slideToggle('slow', function() {
				if (Cookies.get('mchat_show_colour')) {
					mChat.$$('colour').slideToggle('slow');
				}
			});
		}

		if (Cookies.get('mchat_show_userlist')) {
			mChat.$$('userlist').slideToggle('slow');
		}

		mChat.$$('colour').html(phpbb.colorPalette('h', 15, 10)).on('click', 'a', function(e) {
			var color = $(this).data('color');
			bbfontstyle('[color=#' + color + ']', '[/color]');
			e.preventDefault();
		});

		mChat.$$('user-sound').change(function() {
			if (this.checked) {
				Cookies.remove('mchat_no_sound');
			} else {
				Cookies.set('mchat_no_sound', 'yes');
			}
		});

		$('#postform').on('keypress', function(e) {
			if (e.which == 13) {
				mChat.add();
				e.preventDefault();
			}
		});

		mChat.$$('input').autoGrowInput();
	}

	$('#page-body').on('click', '[data-mchat-action]', function(e) {
		var action = $(this).data('mchat-action');
		mChat[action].call(this);
		e.preventDefault();
	}).on('click', '[data-mchat-toggle]', function(e) {
		var elem = $(this).data('mchat-toggle');
		mChat.toggle(elem);
		e.preventDefault();
	});
});
