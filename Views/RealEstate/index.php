<div class="container">
    <h2>Резултаты поиска</h2>
    <table class="table">
        <thead>
        <tr>
            <th>Издание</th>
            <th>Кол-во комнат</th>
            <th>Адрес</th>
            <th>Метро</th>
            <th>Этаж</th>
            <th>Тип дома</th>
            <th>Площадь (общая, жилая, кухня)</th>
            <th>Телефон</th>
            <th>Санузел</th>
            <th>Контакт</th>
            <th>Доп. сведения</th>
        </tr>
        </thead>
        <tbody>
        <? foreach($RealEstate as $result):?>
            <tr>
                <td><a href="<?=$result['url']?>"><?=$result['url']?></a></td>
                <td><?=$result['rooms']?></td>
                <td><?=$result['address']?></td>
                <td><?=$result['metro']?> Район</td>
                <td><?=$result['floors']?></td>
                <td><?=$result['houseType']?></td>
                <td><?=$result['area']?>*<?=$result['areaLiving']?>*<?=$result['areaKitchen']?></td>
                <td><?=$result['phone']?></td>
                <td><?=$result['toilet']?></td>
                <td><?=$result['seller']?></td>
                <td><?=$result['notes']?></td>
            </tr>
        <? endforeach;?>
        </tbody>
    </table>
</div>
