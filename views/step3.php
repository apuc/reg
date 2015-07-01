<div class="container">
    <form method="post" id="address_form" class="rf">
        <p>
            <input type="text" id="region" name="region" value="" placeholder="Регион"/>
        </p>

        <p>
            <input type="text" id="city" name="city" value="" placeholder="Город"/>
        </p>

        <p>
            <input type="text" id="street" name="street" value="" placeholder="Улица"/>
        </p>

        <p>
            <input type="text" id="index" name="index" value="" placeholder="Индекс"/>
        </p>

        <p>
            <select name="house_type" id="house_type">
                <option value="Дом">Дом</option>
                <option value="Владение">Владение</option>
                <option value="Другое">Другое</option>
            </select>
        </p>
        <p>
            <input type="text" id="house" name="house" value="" placeholder="Номер дома"/>
        </p>

        <p>
            <select name="kv_type" id="house_type">
                <option value="Квартира">Квартира</option>
                <option value="Офис">Офис</option>
            </select>
        </p>
        <p>
            <input type="text" id="kv" name="house" value="" placeholder="Номер квартиры"/>
        </p>
        <p>
            <input type="button" class="btn_submit" id="send_address_info" value="Сохранить"/>
        </p>
    </form>
</div>