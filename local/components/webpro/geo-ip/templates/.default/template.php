<?php
?>
<div class="container">
    <h2 class="mt-2">Форма GeoIP поиска</h2>
    <div class="row">
        <form id="geo-ip-form">
            <div class="form-group">
                <label for="ipaddress">IP</label>
                <input required pattern="^\d+\.\d+\.\d+\.\d+$" type="text" class="form-control" id="ipaddress" name="IP" placeholder="Введите валидный ip">
            </div>
            <button type="submit" class="btn btn-primary mt-2">Отправить</button>
        </form>
    </div>
    <div class="row mt-2">
        <div id="response-message" class="alert"></div>
    </div>
</div>