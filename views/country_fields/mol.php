<div class="mol">
    <h4>Молдова</h4>
    <p>
        Серия и номер паспорта <br/>
        <input type="text" name="pasporNumb" pattern="[0-9]{10}" placeholder="0000000000" required>
    </p>
    <p>Дата выдачи <br/><input type="text" name="pasportDate" pattern="\d{2}.\d{2}.\d{4}" required placeholder="ДД.ММ.ГГГГ"/></p>
    <p>Наименование органа, выдавшего документ <br/>
        <input type="text" name="pasportGive" required/>
    </p>
    <p>
        Код подразделения <br/>
        <input type="text" name="kodPod" pattern="[0-9]{3}\-[0-9]{3}" placeholder="000-000" required/>
    </p>
</div>