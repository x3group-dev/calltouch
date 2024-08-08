<?php
/**
 * @var string $cookieKey
 */
?>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        let interval = setInterval(() => {
            if (!isFunction(window['ct']) || !window.ct('calltracking_params')) {
                return;
            }

            window.ct('calltracking_params').forEach(account => {
                const name = "<?php echo $cookieKey ?>#ID#".replace('#ID#', account.modId);
                const value = JSON.stringify(account);
                document.cookie = `${name}=${value}86000;path=/`
            });

            clearInterval(interval);
        });

        const isFunction =  function(value)  {
            let getType = {};
            return value && getType.toString.call(value) === '[object Function]';
        }
    });
</script>