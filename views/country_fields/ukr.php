<div class="ukr">
    <h4>Украина</h4>
    <p>
        Серия и номер паспорта <br/>
        <input type="text" name="pasporNumb" pattern="[А-ЯЁ]{2}[0-9]{3}[0-9]{3}" placeholder="АА000000" required>
    </p>
    <p>Дата выдачи <br/><input type="text" name="pasportDate" pattern="\d{2}.\d{2}.\d{4}" required placeholder="ДД.ММ.ГГГГ"/></p>
    <p>
        Орган, выдавший документ <br/>
        <input type="text" name="pasportGive" required/>
    </p>
    <p>
        Персональный номер <br/>
        <input type="text" name="kodPod" pattern="[0-9]{10}" required placeholder="0000000000">
    </p>
</div>