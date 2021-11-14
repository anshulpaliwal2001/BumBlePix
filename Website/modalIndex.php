
    if($check_project)
    {
        while ($row=mysqli_fetch_array($query_run))
        {
            ?>
            <div id="Service-modal" class="uk-modal-full" uk-modal>
                <div class="uk-modal-dialog">
                    <button class="uk-modal-close-full uk-close-large" type="button" uk-close></button>
                    <div class="uk-grid-collapse uk-child-width-1-2@s uk-flex-middle" uk-grid>
                        <div class="uk-background-cover" style="background-image: url(' <?php echo "$row[service_image]"; ?>');" uk-height-viewport></div>
                        <div class="uk-padding-large">
                            <h1> <?php echo "$row[service_title]"; ?></h1>
                            <p> <?php echo "$row[service_details]"; ?></p>
                        </div>
                    </div>
                </div>
            </div>



