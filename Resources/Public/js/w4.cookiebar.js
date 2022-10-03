var W4;

jQuery(function($) {
    'use strict';

    W4 = W4 || {};

    W4.CookieBar = {
        _data: {
            domainName: 'example.com',
            cookieNameA: '_cookiebar_v2_a',
            cookieNameM: '_cookiebar_v2_m',
            cookieNameDismissed: '_cookiebar_v2_dismissed',
        },

        _options: {
            mainWrapperSelector: '#cookie_bar_v2',
            contentWrapperSelector: '#cookie_bar_v2_content',

            buttonAllowAllSelector: '#cookie_bar_allow_all',
            buttonAllowSelectedSelector: '#cookie_bar_allow_selected',

            optionCookieASelector: '#cookie_bar_check_a',
            optionCookieMSelector: '#cookie_bar_check_m',

            // button ids for conditional maps popup confirmation
            optionAcceptMapsBaidu: '#accept-baidu-maps',
            optionAcceptMapsGoogle: '#accept-google-maps',
            optionAcceptMarketing: '#accept-marketing',
            optionAcceptMapsGoogleWrapper: '.cookie-conditional-google-maps > .gdpr-hint-wrapper',
            optionAcceptMarketingWrapper: '.cookie-conditional-marketing > .gdpr-hint-wrapper',

            // this link should be displayed after text on data privacy page
            buttonEditCookieBannerSelector: 'a.showCookieBanner, #cookie_bar_edit_button a',

            cookieExpiresDays: 30,
        },

        data: function() {
            return this._data;
        },

        options: function () {
            return this._options;

        },

        init: function (data, options) {
            if (typeof data.domainName !== 'undefined') {
                // @TODO ltrim www. from domainName
            }

            if (typeof data.cookieId !== 'undefined') {
                if (typeof data.cookieNameA === 'undefined') {
                    data.cookieNameA = data.cookieId + '_cookiebar_v2_a';
                }

                if (typeof data.cookieNameM === 'undefined') {
                    data.cookieNameM = data.cookieId + '_cookiebar_v2_m';
                }

                if (typeof data.cookieNameDismissed === 'undefined') {
                    data.cookieNameDismissed = data.cookieId + '_cookiebar_v2_dismissed';
                }
            }

            this._data = $.extend(this.data(), data || {});
            this._options = $.extend(this.options(), options || {});

            this.register();
            this.load();
        },

        createCookie: function(cookieName) {
            $.cookie(
                cookieName,
                Date.now(),
                {
                    path: '/',
                    expires: this.options().cookieExpiresDays
                }
            );
        },

        removeCookie: function(cookieName, domain) {
            var domainName = (typeof domain !== 'undefined') ? domain : this.data().domainName;

            $.cookie(cookieName, '', { expires: -1, path: '/'});

            $.each(['.' + domainName, 'www.' + domainName, window.location.host, '.'+window.location.host], function(i, host) {
                $.cookie(cookieName, '', { expires: -1, path: '/', domain: host});
            })
        },

        removeAll: function() {
            $.each($.cookie(), function(cookieName) {
                this.removeCookie(cookieName);
            }.bind(this));
        },

        showCookieBanner: function() {
            if ($.cookie(this.data().cookieNameA)) {
                $(this.options().optionCookieASelector).prop("checked", true);
            }

            if ($.cookie(this.data().cookieNameM)) {
                $(this.options().optionCookieMSelector).prop("checked", true);
            }

            $(this.options().mainWrapperSelector).show();
        },

        register: function() {
            $(this.options().buttonAllowAllSelector).on('click', function(e) {
                e.preventDefault();
                $(this.options().contentWrapperSelector + ' input[type="checkbox"]').prop("checked", true);
                $(this.options().buttonAllowSelectedSelector).trigger('click');
            }.bind(this));

            $(this.options().buttonAllowSelectedSelector).on('click', function(e){
                e.preventDefault();

                if ($(this.options().optionCookieASelector).is(':checked')) {
                    this.createCookie(this.data().cookieNameA);
                } else {
                    this.removeAll();
                }

                if ($(this.options().optionCookieMSelector).is(':checked')) {
                    this.createCookie(this.data().cookieNameM);
                } else {
                    this.removeCookie(this.data().cookieNameM);
                }

                this.createCookie(this.data().cookieNameDismissed);
                $(this.options().mainWrapperSelector).hide();
                $('html').trigger(this.data().cookieNameDismissed);



            }.bind(this));

            $(this.options().buttonEditCookieBannerSelector).click(function(e){
                this.showCookieBanner();
                e.preventDefault();

                return false;
            }.bind(this));

            /* cookie conditional google maps popup ok button */
            $(this.options().optionAcceptMapsGoogle).on('click', function() {
                this.createCookie(this.data().cookieNameM);
                /* close the popup */

                /*
                 * when banner open
                 * select maps + close banner
                 */
                $(this.options().optionCookieMSelector).trigger('click');
                //$(this.options().optionAcceptMapsGoogleWrapper).hide();
                $(this.options().buttonAllowSelectedSelector).trigger('click');
            }.bind(this));

            /* cookie conditional marketing popup ok button */
            $(this.options().optionAcceptMarketing).on('click', function() {
                this.createCookie(this.data().cookieNameA);
                /* close the popup */

                /*
                 * when banner open
                 * select maps + close banner
                 */
                $(this.options().optionCookieASelector).trigger('click');
                $(this.options().buttonAllowSelectedSelector).trigger('click');
            }.bind(this));

        },

        load: function() {
            if (!$.cookie(this.data().cookieNameDismissed)){
                this.removeAll();
                this.showCookieBanner();
            }
        },
    };

    $(function() {
        W4.CookieBar.init(
            {
                cookieId: jQuery('#cookieKey').data('key'),
                domainName: jQuery('#cookieKey').data('domainname'),
            }
        );
    });
});
