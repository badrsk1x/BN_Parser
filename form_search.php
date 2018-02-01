<?

use Vendor\Transport\Transport ;
use Vendor\Search\Search;

$obj = new Transport();
$metros = $obj->GetMetroFromFile(METRO_FILE);

$results = new Search($_POST);

?>
<form id="booking-form" class="booking-form" name="form1" method="post" action="/index.php">
    <div class="h1">веб-приложение для получения информации с сайта bn.ru</div>

    <div id="form-content">
        <div class="group">
            <label for="room-from">Кол-во комнат: от</label>
            <div class="addon-right">
                <input id="room-from" name="room-from" class="form-control" type="text" value="<?=$results->RoomFrom ?>">
            </div>
        </div>
        <div class="group">
            <label for="room-to">До</label>
            <div class="addon-right">
                <input id="room-to" name="room-to" class="form-control" type="text" value="<?=$results->RoomTo ?>">
            </div>
        </div>


        <div class="group">
            <label for="price-from">Цена: от</label>
            <div class="addon-right">
                <input id="price-from" name="price-from" class="form-control" value="<?=$results->PriceFrom ?>" type="text">
            </div>
        </div>
        <div class="group">
            <label for="price-to">До</label>
            <div class="addon-right">
                <input id="price-to" name="price-to" class="form-control" value="<?=$results->PriceTo ?>" type="text">
            </div>
        </div>


        <div class="group">
            <label for="metro">Метро</label>
            <div>
                <select name="metro[]" id="metro" size="19" multiple="" class="form-multiple-control">
                    <? foreach($metros as $metro){?>
                    <option value="<?=$metro->Id;?>"
                        <? if(in_array($metro->Id,$results->Metro)):?>selected="selected"<? endif;?>>
                        <?=$metro->Name;?>
                    </option>
                    <?}?>
                </select>
            </div>
        </div>

        <div class="group submit">
            <label class="empty"></label>
            <div><input name="submit" type="submit" value="Найти" id="submit"/></div>
        </div>

    </div>
</form>

<div id="results"></div>