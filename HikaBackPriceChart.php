<?php
defined('_JEXEC') or die('Restricted access');

/*
* A payment plugin called "example". This is the main file of the plugin.
*/

// You need to extend from the hikashopPaymentPlugin class which already define lots of functions in order to simplify your work
class plgHikashopHikaBackPriceChart extends JPlugin
{
	
function onHikashopAfterDisplayView(&$view) {
		if (JRequest::getVar('option')==='com_hikashop' AND JRequest::getVar('ctrl')==='product' AND JRequest::getVar('task')==='show') {

		if($view->getName() == 'product') {

			if($view->getLayout() == 'show_quantity') {
				$priceparams = $this->params->get('price');

				if (!empty($this->params->get('months'))) {
					$monthsparams = $this->params->get('months');
				}else {
					$monthsparams = "'مهر', 'آبان', 'آذر', 'دی', 'بهمن', 'آذر', 'فروریدن'";
				}
				
				if (!empty($priceparams)) {
					$chrtlinePriceHikashop = $view->escape($view->element->$priceparams);
				} 
				JHtml::script('https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.2.2/Chart.bundle.js');
				JHtml::script('http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js');
				JHtml::script('./jquery.slModal.js');
				JHtml::script(JURI::root().'plugins/hikashop/plg_hikabackpricechart/jquery.slModal.js');
				JHtml::stylesheet(JURI::root().'plugins/hikashop/plg_hikabackpricechart/jquery.slModal.css');
				JHtml::stylesheet('https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css');

    	
				    	$document = JFactory::getDocument();
					$document->addScriptDeclaration('
					 	$().slModal() 
					');

					echo '<a data-modal="searchBox" class="pure-button button-success"><i class="fa fa-bar-chart-o" aria-hidden="true"></i> نمودار قیمت </a>';
					
					echo '<div id="searchBox" class="slModal ">';
					          	echo '<fieldset>';
					            echo '<canvas id="Chartonpage" class="span12 chartsjs"></canvas>';
					        	echo '</fieldset>';   	
					echo '</div>';

					// echo '<canvas id="Chartonpage" width="100%" height="40%" style="display: block; width: 100%; height: 40%;"></canvas>';
				echo "<script> 

					var options = {
					    responsive: true,
					    maintainAspectRatio: true,
					};
					var ctx = document.getElementById('Chartonpage');

						var data = {
						    labels: [$monthsparams],
						    datasets: [
						        {
						            label: 'نمودار قیمت',
						            fill: false,
						            lineTension: 0.1,
						            backgroundColor: 'rgba(75,192,192,0.4)',
						            borderColor: 'rgba(75,192,192,1)',
						            borderCapStyle: 'butt',
						            borderDash: [],
						            borderDashOffset: 0.0,
						            borderJoinStyle: 'miter',
						            pointBorderColor: 'rgba(75,192,192,1)',
						            pointBackgroundColor: '#fff',
						            pointBorderWidth: 1,
						            pointHoverRadius: 5,
						            pointHoverBackgroundColor: 'rgba(75,192,192,1)',
						            pointHoverBorderColor: 'rgba(220,220,220,1)',
						            pointHoverBorderWidth: 2,
						            pointRadius: 1,
						            pointHitRadius: 10,
						            data: [$chrtlinePriceHikashop],
						            spanGaps: false,
						        }
						    ]
						};



					var myLineChart = new Chart(ctx, {
					    type: 'line',
					    data: data,
					    options: options
					});

				</script>";
			}
		}
	}
     }
 }
     ?>
