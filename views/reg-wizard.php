
<div class="wizard" data-initialize="wizard" id="myWizard">
    <div class="steps-container">
        <ul class="steps">
            <li data-step="1" data-name="campaign" class="active"><span class="badge">1</span>Тип документа<span class="chevron"></span></li>
            <li data-step="2"><span class="badge">2</span>Паспортные данные<span class="chevron"></span></li>
            <li data-step="3" data-name="template"><span class="badge">3</span>Сведения об адресе<span class="chevron"></span></li>
            <li data-step="4" data-name="template"><span class="badge">4</span>Выбор ОКВЭД<span class="chevron"></span></li>
            <li data-step="5" data-name="template"><span class="badge">5</span>Документы для регистрации ИП готовы!<span class="chevron"></span></li>
        </ul>
    </div>
    <div class="actions">
        <button type="button" class="btn btn-default btn-prev"><span class="glyphicon glyphicon-arrow-left"></span>Назад</button>
        <button type="button" class="btn btn-default btn-next" data-last="Complete" disabled>Далее<span class="glyphicon glyphicon-arrow-right"></span></button>
    </div>
    <div class="step-content">
        <div class="step-pane active sample-pane alert" data-step="1">
            {step1}
        </div>
        <div class="step-pane sample-pane bg-info alert" data-step="2">
            {step2}
         </div>
        <div class="step-pane sample-pane bg-danger alert" data-step="3">
            {step3}
        </div>
        <div class="step-pane sample-pane bg-danger alert" data-step="4">
            <h4>Выбор ОКВЭД</h4>
            <p>Укажите вид деятельности:</p>
            <!--<p><input type="text" id="okved-input" style="width: 90%" name="okved-input"/></p>-->
            <p>
                <a href="#" id="show-modal" onclick="return false">Выбрать</a>
            </p>
            <div id='okved-wiz'></div>
        </div>
        <div class="step-pane sample-pane bg-danger alert" data-step="5">
            <h4>Документы для регистрации ИП готовы!</h4>

            <form action="" method="post">
                <p>
                    Введите e-mail, на который следует отправить готовый комплект документов для регистрации ИП:
                </p>
                <p>
                    <input style="width: 80%" type="text" id="user_email_doc" name="user_email_doc" placeholder="Email"/>
                </p>
                <p>
                    Выберите способ получения готовых документов из налоговой инспекции:
                </p>
                <p>
                    <input type="radio" name="del_type"/>Выдать заявителю
                    <input type="radio" name="del_type"/>Отправить по почте
                    <input type="radio" name="del_type"/>Выдать представителю
                </p>
                <p>
                    <input type="submit" value="Отправить"/>
                </p>
            </form>
        </div>
    </div>
</div>

