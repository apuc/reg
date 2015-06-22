<div class="container">
    <div class="wizard" data-initialize="wizard" id="myWizard">
        <div class="steps-container">
            <ul class="steps">
                <li data-step="1" data-name="campaign" class="active"><span class="badge">1</span>Тип документа<span class="chevron"></span></li>
                <li data-step="2"><span class="badge">2</span>Паспортные данные<span class="chevron"></span></li>
                <li data-step="3" data-name="template"><span class="badge">3</span>Сведения об адресе<span class="chevron"></span></li>
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
        </div>

    </div>
</div>
