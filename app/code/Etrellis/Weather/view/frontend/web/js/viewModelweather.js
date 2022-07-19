define([
    'jquery',
    'uiComponent',
    'ko',
    'mage/storage',
    'mage/translate',
    'Magento_Ui/js/modal/alert',
    'mage/url'
], function($,Component, ko, storage, $t, alert, urlBuilder) {
    'use strict';

    const weatherApiUrl = 'rest/V1/etrellis-weather/weather';
    return Component.extend({

        initialize: function () {
            this._super();
            storage.get(
                weatherApiUrl
                ).done(function(response){
                    var resjson = JSON.parse(response);
                    this.weatherDesc = resjson.weather[0].description;
                    this.weatherIcon = "http://openweathermap.org/img/w/"+resjson.weather[0].icon+".png";

                    $('.lableCity').html(resjson.name);
                    $('.weatherDisc').html(resjson.weather[0].description.toUpperCase());
                    $('.weather-icon').html(resjson.weather[0].description);
                    $(".weather-icon").attr("src","http://openweathermap.org/img/w/"+resjson.weather[0].icon+".png");

                    
                    $('.tempmax').html(resjson.main.temp_max+String.fromCharCode(176)+"C");
                    $('.minTemperature').html(resjson.main.temp_min+String.fromCharCode(176)+"C");
                    $('.humidity').html("Humidity: "+resjson.main.humidity+"%");
                    $('.windcheck').html("Wind: "+resjson.wind.speed+"km/h");
            }).fail(function (response){
                    console.log(response);
            });
        }
    });
});
