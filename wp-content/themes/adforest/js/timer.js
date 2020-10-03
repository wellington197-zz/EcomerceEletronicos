jQuery(function($){
    function timer(config){
		var settings;
        function prependZero(number){
            return number < 10 ? '0' + number : number;
        }
        $.extend(true, config, settings || {});
        var currentTime = moment();
        var endDate = moment.tz(config.endDate, config.timeZone);
        var diffTime = endDate.valueOf() - currentTime.valueOf();
        var duration = moment.duration(diffTime, 'milliseconds');
        var days = Math.floor(duration.asDays());
        var interval = 1000;
        var subMessage = $('.sub-message');
        var clock = $('.clock');
        if(diffTime < 0){
            endEvent(subMessage, config.newSubMessage, clock);
            return;
        }
        if(days > 0){
            config.days.text(prependZero(days));
            //$('.days').css('display', 'inline-block');
        }
        var intervalID = setInterval(function(){
            duration = moment.duration(duration - interval, 'milliseconds');
            var hours = duration.hours(),
                minutes = duration.minutes(),
                seconds = duration.seconds();
            days = Math.floor(duration.asDays());
            if(hours  <= 0 && minutes <= 0 && seconds  <= 0 && days <= 0){
                clearInterval(intervalID);
                endEvent(subMessage, config.newSubMessage, clock);
                //window.location.reload();
            }
            if(days === 0){
                //$('.days').hide();
            }
             config.days.text(prependZero(days));
            config.hours.text(prependZero(hours));
            config.minutes.text(prependZero(minutes));
            config.seconds.text(prependZero(seconds));
        }, interval);
    }
    function endEvent($el, newText, hideEl){
		if( $('.bid_close').length > 0 )
       		$('.bid_close').show();
        hideEl.hide();
    }
	
	
	$('.clock').each(function(index, element) {
		var ref = $(this).attr('data-rand');
	
		var aaaaa = $(this).closest('div.days-'+ref);
	  	//alert( aaaaa );
		var config = {
            endDate: $(this).attr('data-date'),
            /*endDate: '2018-05-23 07:01:10',*/
            days: $('.days-'+ref),
            hours: $('.hours-'+ref),
            minutes: $('.minutes-'+ref),
            seconds: $('.seconds-'+ref),
            newSubMessage: '',
        };
		
        timer(config );
    });
	
	
    
});