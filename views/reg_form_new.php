<div class="container">
    <form method="post" id="reg-user">
        <div class="tabs">
            <ul>
                <li>Общее</li>
                <li>Паспортные данные</li>
                <li>Населенный пункт</li>
                <li>Адрес</li>
                <li>Контакты</li>
            </ul>
            <div>
                <div>
                    <p>Фамилия <br/><input type="text" name="lastName" pattern="[А-ЯЁ][а-яё]+" required placeholder="Фамилия"/></p>

                    <p>Имя <br/><input type="text" name="firstName" pattern="[А-ЯЁ][а-яё]+" required placeholder="Имя"/></p>

                    <p>Отчество <br/><input type="text" name="middleName" pattern="[А-ЯЁ][а-яё]+" required placeholder="Отчество"/></p>

                    <p>Дата рождения <br/><input type="text" name="birthday"  pattern="\d{2}.\d{2}.\d{4}" required placeholder="ДД.ММ.ГГГГ"/></p>

                    <p>Место рождения <br/><input type="text" name="birthdayPlace" required /></p>

                    <p>Пол <br/><input type="radio" name="Sex" value="Мужской" checked="checked" required/> Мижской<br />
                        <input type="radio" name="Sex" value="Женский" /> Женский<br /></p>
                </div>
                <div>
                    <p>Гражданство
                        <select name="country" id="country" required>
                            <option value="0">Выбрать</option>
                            <option value="mol">Молдова</option>
                            <option value="ru">Россия</option>
                            <option value="ukr">Украина</option>
                        </select>
                    </p>
                    <div class="country-box"></div>
                    <p>
                        Номер ИНН <br/>
                        <input type="text" name="inn" pattern="[0-9]{10}" required placeholder="000000000000">
                    </p>
                </div>
                <div>Третье содержимое</div>
                <div>4 содержимое</div>
                <div>
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
                </div>
            </div>
        </div>
    </form>

</div>
