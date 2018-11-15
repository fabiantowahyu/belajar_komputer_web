<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<!--page specific plugin scripts-->

<!--[if lte IE 8]>
  <script src="<?php //echo base_url(); ?>themes/js/excanvas.min.js"></script>
<![endif]-->

<script src="<?php echo base_url(); ?>themes/js/jquery.validate.min.js"></script>
<script src="<?php echo base_url(); ?>themes/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>themes/js/jquery.dataTables.bootstrap.js"></script>

<script src="<?php echo base_url(); ?>themes/js/jquery-ui-1.10.3.custom.min.js"></script>
<script src="<?php echo base_url(); ?>themes/js/jquery.ui.touch-punch.min.js"></script>
<script src="<?php echo base_url(); ?>themes/js/jquery.slimscroll.min.js"></script>
<script src="<?php echo base_url(); ?>themes/js/jquery.easy-pie-chart.min.js"></script>
<script src="<?php echo base_url(); ?>themes/js/jquery.sparkline.min.js"></script>
<script src="<?php echo base_url(); ?>themes/js/flot/jquery.flot.min.js"></script>
<script src="<?php echo base_url(); ?>themes/js/flot/jquery.flot.pie.min.js"></script>
<script src="<?php echo base_url(); ?>themes/js/flot/jquery.flot.resize.min.js"></script>

<!--inline scripts related to this page-->

<script type="text/javascript">
// Pie Chart
    $('.easy-pie-chart.percentage').each(function () {
	var $box = $(this).closest('.infobox');
	var barColor = $(this).data('color') || (!$box.hasClass('infobox-dark') ? $box.css('color') : 'rgba(255,255,255,0.95)');
	var trackColor = barColor == 'rgba(255,255,255,0.95)' ? 'rgba(255,255,255,0.25)' : '#E2E2E2';
	var size = parseInt($(this).data('size')) || 50;
	$(this).easyPieChart({
	    barColor: barColor,
	    trackColor: trackColor,
	    scaleColor: false,
	    lineCap: 'butt',
	    lineWidth: parseInt(size / 10),
	    animate: /msie\s*(8|7|6)/.test(navigator.userAgent.toLowerCase()) ? false : 1000,
	    size: size
	});
    })

    $('.sparkline').each(function () {
	var $box = $(this).closest('.infobox');
	var barColor = !$box.hasClass('infobox-dark') ? $box.css('color') : '#FFF';
	$(this).sparkline('html', {tagValuesAttribute: 'data-values', type: 'bar', barColor: barColor, chartRangeMin: $(this).data('min') || 0});
    });

    /*var placeholder = $('#piechart-placeholder').css({'width':'90%' , 'min-height':'150px'});
     var data = <?php echo $result_product; ?>;
     function drawPieChart(placeholder, data, position) {
     $.plot(placeholder, data, {
     series: {
     pie: {
     show: true,
     tilt:0.8,
     highlight: {
     opacity: 0.25
     },
     stroke: {
     color: '#fff',
     width: 1
     },
     startAngle: 2
     }
     },
     legend: {
     show: true,
     position: position || "ne", 
     labelBoxBorderColor: null,
     margin:[-25,15]
     },
     grid: {
     hoverable: true,
     clickable: true
     }
     })
     }
     drawPieChart(placeholder, data);*/

    /**
     we saved the drawing function and the data to redraw with different position later when switching to RTL mode dynamically
     so that's not needed actually.
     */
    /*placeholder.data('chart', data);
     placeholder.data('draw', drawPieChart);*/

    /*var $tooltip = $("<div class='tooltip top in hide'><div class='tooltip-inner'></div></div>").appendTo('body');
     var previousPoint = null;
     
     placeholder.on('plothover', function (event, pos, item) {
     if(item) {
     if (previousPoint != item.seriesIndex) {
     previousPoint = item.seriesIndex;
     var tip = item.series['label'] + " : " + item.series['percent']+'%';
     $tooltip.show().children(0).text(tip);
     }
     $tooltip.css({top:pos.pageY + 10, left:pos.pageX + 10});
     } else {
     $tooltip.hide();
     previousPoint = null;
     }
     });*/
</script>
