<?if(count($messages)>0):?>
    <div class="row">
        <?foreach($messages as $msg):?>
            <div class="col-md-12">
                <div class="alert alert-<?=$msg->state?>" role="alert">
                    <strong><?=$msg->title?></strong> <br /> <?=nl2br($msg->text)?>
                </div>
            </div>
        <?endforeach?>
    </div>
<?endif?>