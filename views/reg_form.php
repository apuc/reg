<h4>Паспортные данные</h4>
<form method="post" id="user_form">

        <p>Фамилия <br/><input type="text" name="lastName" pattern="[А-ЯЁ][а-яё]+" required placeholder="Фамилия"/></p>

        <p>Имя <br/><input type="text" name="firstName" pattern="[А-ЯЁ][а-яё]+" required placeholder="Имя"/></p>

        <p>Отчество <br/><input type="text" name="middleName" pattern="[А-ЯЁ][а-яё]+" required placeholder="Отчество"/></p>

        <p>Дата рождения <br/><input type="text" name="birthday"  pattern="\d{2}.\d{2}.\d{4}" required placeholder="ДД.ММ.ГГГГ"/></p>

        <p>Место рождения <br/><input type="text" name="birthdayPlace" required /></p>

        <p>Пол <br/><input type="radio" name="Sex" value="Мужской" checked="checked" required/> Мижской<br />
            <input type="radio" name="Sex" value="Женский" /> Женский<br /></p>
        <p>Гражданство
            <select name="country" id="country" required>
                <option value="0">Выбрать</option>
                <option value="mol">Молдова</option>
                <option value="ru">Россия</option>
                <option value="ukr">Украина</option>
            </select>
        </p>
        <!--<div class="mol">
            <h4>Молдова</h4>
            <p>
                Серия и номер паспорта <br/>
                <input type="text" name="pasporNumbMol" pattern="[0-9]{10}" placeholder="0000000000" required>
            </p>
            <p>Дата выдачи <br/><input type="text" name="pasportDateMol" pattern="\d{2}.\d{2}.\d{4}" required placeholder="ДД.ММ.ГГГГ"/></p>
            <p>Наименование органа, выдавшего документ <br/>
                <input type="text" name="pasportGiveMol" required/>
            </p>
            <p>
                Код подразделения <br/>
                <input type="text" name="kodPodMol" pattern="[0-9]{3}\-[0-9]{3}" placeholder="000-000" required/>
            </p>
        </div>
        <div class="ru">
            <h4>Россия</h4>
            <p>
                Серия и номер паспорта <br/>
                <input type="text" name="pasporNumbRu" pattern="[0-9]{10}" placeholder="0000000000" required>
            </p>
            <p>Дата выдачи <br/><input type="text" name="pasportDateRu" pattern="\d{2}.\d{2}.\d{4}" required placeholder="ДД.ММ.ГГГГ"/></p>
            <p>Наименование органа, выдавшего документ <br/>
                <input type="text" name="pasportGiveRu" required/>
            </p>
            <p>
                Код подразделения <br/>
                <input type="text" name="kodPodRu" pattern="[0-9]{3}\-[0-9]{3}" placeholder="000-000" required/>
            </p>
        </div>
        <div class="ukr">
            <h4>Украина</h4>
            <p>
                Серия и номер паспорта <br/>
                <input type="text" name="pasporNumbUkr" pattern="[А-ЯЁ]{2}[0-9]{3}[0-9]{3}" placeholder="АА000000" required>
            </p>
            <p>Дата выдачи <br/><input type="text" name="pasportDateUkr" pattern="\d{2}.\d{2}.\d{4}" required placeholder="ДД.ММ.ГГГГ"/></p>
            <!-- <p>Наименование органа, выдавшего документ <br/>
                 <input type="text"  required/>
             </p>
            <p>
                Орган, выдавший документ <br/>
                <input type="text" name="pasportGiveUkr" required/>
            </p>
            <p>
                Персональный номер <br/>
                <input type="text" name="personNumbUkr_2" pattern="[0-9]{10}" required placeholder="0000000000">
            </p>

        </div>-->

        <div class="country-box"></div>

        <p>
            Номер ИНН <br/>
            <input type="text" name="inn" pattern="[0-9]{10}" required placeholder="000000000000">
        </p>

        <p>Домашний телефон <br/>
            <input type="hidden" name = "phoneCode" value="+373" required>
            <input type="text" name="phoneCity" id="phoneCity" pattern="\([0-9]{3}\)" required placeholder="(000)"/>
            <input type="text" name="phoneNumb" id="phoneNumb" pattern="[0-9]{1}\-[0-9]{2}\-[0-9]{2}" required placeholder="0-00-00"/>
        </p>

        <p>Мобильный телефон <br/>
            <input type="text" name="mobileNumb" id="mobileNumb" pattern="\+[0-9]{3}\([0-9]{3}\)[0-9]{1}\-[0-9]{2}\-[0-9]{2}" required placeholder="+373 (000) 0-00-00"/>
        </p>
        <p>E-mail <br/>
            <input name="email" type="email"/>
        </p>


        <input type="button" id="send_user_info" value="Отправить"/>
</form>
