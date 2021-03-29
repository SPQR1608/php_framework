<div class="container">
    <button class="btn btn-default" id="send">Send</button>
    <?php if (!empty($posts)):?>
        <?php foreach ($posts as $post):?>
            <div class="panel panel-default">
                <div class="panel-heading"><?=$post['title']?></div>
                <div class="panel-body">
                    <?=$post['text']?>
                </div>
            </div>
        <?php endforeach;?>
    <?php endif;?>
</div>
<script>
    document.querySelector('#send').addEventListener('click', event => {
        fetch('/main/ajax/', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8'
            },
            body: 'id=2&fetch=y'
        }).then(response  => {
            response = response.text()
        }).then(result => {
            console.log(result)
        })
    })
</script>