var playerUrl;
$(document).ready(function () {
    Amplitude.init({
        'songs': [{'url': playerUrl, 'cover_art_url': '/images/cd.png'}],
        'callbacks': {
            'timeupdate': function () {
                var songPlayedPercentage = Amplitude.getSongPlayedPercentage();
                if (bar && songPlayedPercentage) {
                    bar.animate(songPlayedPercentage / 100);
                }
            },
            'ended': function () {
                bar.set(1);
                setTimeout(bar.animate(0), 4000);
            }
        }
    });
});