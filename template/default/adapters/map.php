<?php
/**
 * @package     ${NAMESPACE}
 * @subpackage
 *
 * @copyright   A copyright
 * @license     A "Slug" license name e.g. GPL2
 */
$this->addScript('https://api-maps.yandex.ru/2.1/?load=package.full&lang=ru_RU');
$this->addScript('classes/adapters/map/script.js?v=2');
?>
<section class="wrapper style1 big align-center" id="<?php echo $this->id; ?>">

        <h2><?php echo $this->title; ?></h2>
    <?php if(count($this->cities)) : ?>
        <div class="chooser">
            <span>Ваш город:</span>
	    <?php foreach($this->cities as $city) : ?>
            <a href="#" data-latitude="<?php echo $city['lat']; ?>" data-longitude="<?php echo $city['lng']; ?>"><?php echo $city['city']; ?></a>
	    <?php endforeach; ?>
        </div>
    <?php endif; ?>

        <div id="map" style="width:100%; height:30rem;"></div>

</section>
<?php ob_start() ?>
    var map;
    ymaps.ready(function () {
        map = new ymaps.Map('map', {
            center: [<?php echo $this->center; ?>], zoom: <?php echo $this->zoom; ?>
        });

        map.behaviors.disable('scrollZoom');

        <?php foreach ( $this->points as $point ) :
            $balloonContent = htmlspecialchars($point['desc']);
            if(!empty(trim($point['site']))) {
	            $balloonContent.= '<br/><a href="'.$point['site'].'" target="_blank">'.str_replace(array('http://', 'https://'), '', $point['site']).'</a>';
            }
        ?>
        map.geoObjects.add(
            new ymaps.Placemark([<?php echo (float)$point['lat']; ?>, <?php echo (float)$point['lng']; ?>], {
                balloonContent: '<?php echo $balloonContent; ?>'
            }, {
                preset: 'islands#redStretchyIcon'
            })
        );
        <?php endforeach; ?>
    });

<?php
$js = ob_get_clean();
$this->addScriptDeclaration($js);
