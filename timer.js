(function () {
    'use strict';

    var eventtime = 1424744309,
        timeLeft = 0,
        timer,
        mytime;

    function pad(value) {
        return (value < 10 ? '0' : '') + value;
    }

    function updateCountdown() {
        timeLeft -= 1;
        var hrs = 3600,
            mins = 60,
            hrsLeft = Math.floor(timeLeft / hrs),
            minLeft = Math.floor((timeLeft % hrs) / mins),
            secLeft = Math.floor(timeLeft % mins);

        document.getElementById('timer').innerHTML = "00 : " + pad(hrsLeft) + " : " + pad(minLeft) + " : " + pad(secLeft);

        if (timeLeft <= 0) {
            clearInterval(timer);
            clearInterval(mytime);
            document.getElementById('timer').innerHTML = "Ended!";
        }
    }

    function getTime() {
        document.getElementById('sync').classList.remove('hidden');
        microAjax('servertime.php', function (newtime) {
            document.getElementById('sync').classList.add('hidden');
            timeLeft = eventtime - newtime;
        });
        if (!timer) {
            timer = setInterval(updateCountdown, 1000);
        }
    }

    function initTime() {
        var refresh_ms = 10000;
        mytime = setInterval(getTime, refresh_ms);
    }

    getTime();
    initTime();
}());
