$(document).ready(function() {


var req = new Request();
req.url = "latestEnquiry";
RequestHandler(req, latestEnquiryResponse);

function latestEnquiryResponse(data) {
    var mydata = JSON.parse(data);
    var str = ''
    for (var i = 0; i < mydata.length; i++) {
        var timeinformat = '';
        if(mydata[i]['timestamp']) {
            var d = new Date(mydata[i]['timestamp']);
            timeinformat = d.toDateString() + ' ' + d.toLocaleTimeString();
        }

        str += `<li class="nk-activity-item">
    <div class="nk-activity-media user-avatar bg-default">`+mydata[i].name.charAt(0)+`</div>
                        <div class="nk-activity-data">
                            <div class="label">`+mydata[i].name+` (`+mydata[i].mobilenumber+`)</div>
                            <span class="time">`+timeinformat+`</span>
                        </div>
                    </li>`;
    }
    $("#recentEnquiry").html(str);
}

var req = new Request();
req.url = "latestUsers";
RequestHandler(req, latestUsersResponse);

function latestUsersResponse(data) {
    var mydata = JSON.parse(data);
    var str = ''
    for (var i = 0; i < mydata.length; i++) {
        var timeinformat = '';
        if(mydata[i]['timestamp']) {
            var d = new Date(mydata[i]['timestamp']);
            timeinformat = d.toDateString() + ' ' + d.toLocaleTimeString();
        }

        str += `<li class="nk-activity-item">
    <div class="nk-activity-media user-avatar bg-default">`+ (mydata[i].name && mydata[i].name.charAt(0) || '')+`</div>
                        <div class="nk-activity-data">
                            <div class="label">`+mydata[i].name+` (`+mydata[i].mobilenumber+`)</div>
                            <span class="time">`+timeinformat+`</span>
                        </div>
                    </li>`;
    }
    $("#recentUsers").html(str);
}



var req = new Request();
req.url = "userWidget";
RequestHandler(req, showResponse);

function showResponse(data) {
    data = JSON.parse(data);
	var totalUserSpanClass="";
	var totalUserEmClass="";
	$("#userSpanClass").removeClass("change up");
	$("#userSpanClass").removeClass("text-danger");
    $("#userEmClass").removeClass("icon ni ni-arrow-long-up");
	if(data.day != 0){
		totalUserSpanClass = "change up text-danger";
		totalUserEmClass = "icon ni ni-arrow-long-up";
	}
	else{
		totalUserSpanClass = "text-danger";
		totalUserEmClass = "";
	}
    $("#total_user").text(data.totaluser);
    $(".userDay").text(data.day);
    $("#week").text(data.week);
    $("#month").text(data.month);
	$("#userSpanClass").addClass(totalUserSpanClass);
    $("#userEmClass").addClass(totalUserEmClass);
}

var enquiry_req = new Request();
enquiry_req.url = "enquiryWidget";
RequestHandler(enquiry_req, showEnquiryResponse);

function showEnquiryResponse(data) {
    data = JSON.parse(data);
	var totalEnquirySpanClass="";
	var totalEnquiryEmClass="";
	$("#spanClass").removeClass("change up");
	$("#spanClass").removeClass("text-danger");
    $("#emClass").removeClass("icon ni ni-arrow-long-up");
	if(data.enquiry_day != 0){
		totalEnquirySpanClass = "change up text-danger";
		totalEnquiryEmClass = "icon ni ni-arrow-long-up";
	}
	else{
		totalEnquirySpanClass = "text-danger";
		totalEnquiryEmClass = "";
	}
    $("#total_enquiry").text(data.totalenquiry);
    $(".enquiry_day").text(data.enquiry_day);
    $(".enquiry_week").text(data.enquiry_week);
    $(".enquiry_month").text(data.enquiry_month);
    $("#spanClass").addClass(totalEnquirySpanClass);
    $("#emClass").addClass(totalEnquiryEmClass);
}

var totalEnquiryDeposit = {
    labels: ["01 Jan", "02 Jan", "03 Jan", "04 Jan", "05 Jan", "06 Jan", "07 Jan"],
    dataUnit: 'USD',
    stacked: true,
    datasets: [{
        label: "Active User",
        color: ["#e0e4ff", "#e0e4ff", "#e0e4ff", "#e0e4ff", "#e0e4ff", "#e0e4ff", "#6576ff"],
        data: [7200, 8200, 7800, 9500, 5500, 9200, 9690]
    }]
};

//User thirty day chart
var req = new Request();
req.url = "thirtyDayUserWidget";
RequestHandler(req, showThirtyDayUserResponse);

function showThirtyDayUserResponse(data) {
    data = JSON.parse(data);
    //$("#total_user").text(data.thirtyDayUserlist[0].YYYYMMDD);
    $("#day").text(data.day);
    $("#week").text(data.week);
    $("#month").text(data.month);
}


jqvmap_init();

function jqvmap_init() {

    var req = new Request();
    req.url = "countryData";
    RequestHandler(req, function (data) {
        var mydata = JSON.parse(data);
        var temparr = [];
        var countrystr = '';
        var statestr = '';
        for (var i = 0; i < mydata.length; i++) {
            temparr[mydata[i].code] = mydata[i].datacount;
            countrystr += `<tr class="analytics-map-data">
                          <td class="country">`+ mydata[i].name + `</td>
                          <td class="amount">`+ mydata[i].datacount + `</td>
                          <td class="percent">`+ mydata[i].percent + ` %</td>
                      </tr>`;
        }
        var countrydata = Object.assign({}, temparr);
        var worldMap = {
            index: 0,
            map: 'world_en',
            data: countrydata
        }
      $("#worlddata").html(countrystr);

      var elm = '.vector-map';
      if ($(elm).exists() && typeof $.fn.vectorMap === 'function') {
        $(elm).each(function () {
          var $self = $(this),
            _self_id = $self.attr('id'),
            map_data = eval(_self_id);

          $self.vectorMap({
            map: map_data.map,
            backgroundColor: 'transparent',
            borderColor: '#dee6ed',
            borderOpacity: 1,
            borderWidth: 1,
            color: '#ccd7e2',
            enableZoom: true,
            hoverColor: '#9cabff',
            hoverOpacity: null,
            normalizeFunction: 'linear',
            scaleColors: ['#ccd7e2', '#798bff'],
            selectedColor: '#6576ff',
            showTooltip: true,
            values: map_data.data,
            onLabelShow: function onLabelShow(event, label, code) {
              var mapData = JQVMap.maps,
                what = Object.keys(mapData)[map_data.index],
                name = mapData[what].paths[code]['name'];
              label.html(name + ' - ' + (map_data.data[code] || 0));
            }
          });
        });
      }



      /*
        var req = new Request();
        req.url = "stateData";
        RequestHandler(req, function (data) {
            var mydata1 = JSON.parse(data);
            var temparr = [];
            for (var i = 0; i < mydata1.length; i++) {
                temparr[mydata1[i].code] = mydata1[i].datacount;
                statestr += `<tr class="analytics-map-data">
                            <td class="country">`+ mydata1[i].name + `</td>
                            <td class="amount">`+ mydata1[i].datacount + `</td>
                            <td class="percent">`+ mydata1[i].percent + ` %</td>
                        </tr>`;
            }
            var statedata = Object.assign({}, temparr);
            var indiaMap = {
                index: 1,
                map: 'in_merc',
                data: statedata
            }

            $("#indiadata").html(statestr);
        }); */

    });
};


// Doughnet chart

/*
    function analyticsDoughnut(selector, set_data) {
        var $selector = selector ? $(selector) : $('.analytics-doughnut');
        $selector.each(function () {
            var $self = $(this),
                _self_id = $self.attr('id'),
                _get_data = (typeof set_data === 'undefined') ? eval(_self_id) : set_data;

            var selectCanvas = document.getElementById(_self_id).getContext("2d");
            var chart_data = [];
            for (var i = 0; i < _get_data.datasets.length; i++) {
                chart_data.push({
                    backgroundColor: _get_data.datasets[i].background,
                    borderWidth: 2,
                    borderColor: _get_data.datasets[i].borderColor,
                    hoverBorderColor: _get_data.datasets[i].borderColor,
                    data: _get_data.datasets[i].data
                });
            }

            var chart = new Chart(selectCanvas, {
                type: 'doughnut',
                data: {
                    labels: _get_data.labels,
                    datasets: chart_data
                },
                options: {
                    responsive: true,
                    legend: {
                        display: _get_data.legend ? _get_data.legend : false,
                        position: _get_data.legendPosition ? _get_data.legendPosition : 'bottom',
                        labels: {
                            boxWidth: 12,
                            padding: 20,
                            fontColor: '#6783b8'
                        }
                    },
                    rotation: -1.5,
                    cutoutPercentage: 70,
                    maintainAspectRatio: false,
                    tooltips: {
                        enabled: true,
                        callbacks: {
                            title: function title(tooltipItem, data) {
                                return data['labels'][tooltipItem[0]['index']];
                            },
                            label: function label(tooltipItem, data) {
                                return data.datasets[tooltipItem.datasetIndex]['data'][tooltipItem['index']] + ' ' + _get_data.dataUnit;
                            }
                        },
                        backgroundColor: '#fff',
                        borderColor: '#eff6ff',
                        borderWidth: 2,
                        titleFontSize: 13,
                        titleFontColor: '#6783b8',
                        titleMarginBottom: 6,
                        bodyFontColor: '#9eaecf',
                        bodyFontSize: 12,
                        bodySpacing: 4,
                        yPadding: 10,
                        xPadding: 10,
                        footerMarginTop: 0,
                        displayColors: false
                    }
                }
            });
        });
    } // init chart

    var TrafficChannelDoughnutData;
    var TrafficChannelDoughnutData1;
    var TrafficChannelDoughnutData2;

    $("#industryDoughnutDays").on('change', function () {
        industryCharts();
    });

    $("#businessTypeDays").on('change', function () {
        businessCharts();
    });

    $("#ourServicesDays").on('change', function () {
        serviceCharts();
    });


    function industryCharts() {
        var industryDoughnutDays = $("#industryDoughnutDays").val();
        var req = new Request();
        req.url = "industryClasification/" + industryDoughnutDays;
        RequestHandler(req, function (data) {
            var industryobj = JSON.parse(data);
            var labels = [];
            var chartdata = [];
            var indu_str = '';
            var colorarr = ["#798bff", "#b8acff", "#ffa9ce", "#f9db7b", "#1c8d4f", "#5330d3", "#a3421c", "#c4628b", "#733e88", "#42ccba"];
            var color_i = 0;
            for (const [key, value] of Object.entries(industryobj)) {
                indu_str += `<div class="traffic-channel-data">
              <div class="title"><span class="dot dot-lg sq" data-bg="` + colorarr[color_i] + `"></span><span>` + key + `</span></div>
              <div class="amount">` + value + `</div>
          </div>`;
                labels.push(key);
                chartdata.push(value);
                color_i++;
            }
            // $("#industryData").html(indu_str);
            TrafficChannelDoughnutData = {
                labels: labels,
                dataUnit: 'People',
                legend: true,
                legendPosition: 'bottom',
                datasets: [{
                    borderColor: "#fff",
                    background: colorarr,
                    data: chartdata
                }]
            };
            analyticsDoughnut('#TrafficChannelDoughnutData', TrafficChannelDoughnutData);
        });

    }

    function businessCharts() {

        var businessTypeDays = $("#businessTypeDays").val();
        var req = new Request();
        req.url = `businessType/${businessTypeDays}`;
        RequestHandler(req, function (data) {
            var industryobj = JSON.parse(data);
            var labels = [];
            var chartdata = [];
            var indu_str = '';
            var colorarr = ["#798bff", "#b8acff", "#ffa9ce"];
            var color_i = 0;
            for (const [key, value] of Object.entries(industryobj)) {
                indu_str += `<div class="traffic-channel-data">
  <div class="title"><span class="dot dot-lg sq" data-bg="` + colorarr[color_i] + `"></span><span>` + key + `</span></div>
  <div class="amount">` + value + `</div>
</div>`;
                labels.push(key);
                chartdata.push(value);
                color_i++;
            }
            // $("#businesstypeData").html(indu_str);
            TrafficChannelDoughnutData1 = {
                labels: labels,
                dataUnit: 'People',
                legend: true,
                legendPosition: 'bottom',
                datasets: [{
                    borderColor: "#fff",
                    background: colorarr,
                    data: chartdata
                }]
            };
            analyticsDoughnut('#TrafficChannelDoughnutData1', TrafficChannelDoughnutData1);
        });
    }

    function serviceCharts() {
        var businessTypeDays = $("#ourServicesDays").val();
        var req = new Request();
        req.url = `ourServices/${businessTypeDays}`;
        RequestHandler(req, function (data) {
            var industryobj = JSON.parse(data);
            var labels = [];
            var chartdata = [];
            var indu_str = '';
            var colorarr = ["#798bff", "#b8acff", "#ffa9ce", "#f9db7b", "#1c8d4f", "#5330d3", "#a3421c", "#c4628b", "#733e88", "#42ccba"];
            var color_i = 0;
            for (const [key, value] of Object.entries(industryobj)) {
                indu_str += `<div class="traffic-channel-data">
          <div class="title"><span class="dot dot-lg sq" data-bg="` + colorarr[color_i] + `"></span><span>` + key + `</span></div>
          <div class="amount">` + value + `</div>
      </div>`;
                labels.push(key);
                chartdata.push(value);
                color_i++;
            }
            // $("#servicesData").html(indu_str);
            TrafficChannelDoughnutData2 = {
                labels: labels,
                dataUnit: 'People',
                legend: true,
                legendPosition: 'bottom',
                datasets: [{
                    borderColor: "#fff",
                    background: colorarr,
                    data: chartdata
                }]
            };
            analyticsDoughnut('#TrafficChannelDoughnutData2', TrafficChannelDoughnutData2);
        });
    }


    industryCharts();
    businessCharts();
    serviceCharts();
    */

})
