<div class="container">

    <!-- Page Header -->
    <div class="row">
        <div class="col-lg-12">
            <br>
            <br>
            <h1 class="page-header" align="center"><?php echo $proyecto->nombre; ?></h1>
            <h3 align="center" style="color: #888888"><?php echo $proyecto->rubro; ?></h3>
        </div>
    </div>

    <br>

    <div id="video" class="col-lg-8">
        <iframe width="560" height="315" src="https://www.youtube.com/embed/<?php echo $proyecto->youtube; ?>" frameborder="0" allowfullscreen></iframe>
    </div>

    <div class="col-lg-4" style="width:300px; height:400px;">
        <h3 style="color: #dd4814">Cantidad de visitas: </h3>
        <h3>xxx</h3>
        <h3 style="color: #dd4814">Cantidad de veces pago: </h3>
        <h3>xxx</h3>
    </div>

    <div class="row">

        <div class="col-lg-8 columns">
            <h4>This is a content section.</h4>
            <p>Bacon ipsum dolor sit amet nulla ham qui sint exercitation eiusmod commodo, chuck duis velit. Aute in reprehenderit, dolore aliqua non est magna in labore pig pork biltong. Eiusmod swine spare ribs reprehenderit culpa. Boudin aliqua adipisicing rump corned beef.</p>
            <p>Pork drumstick turkey fugiat. Tri-tip elit turducken pork chop in. Swine short ribs meatball irure bacon nulla pork belly cupidatat meatloaf cow. Nulla corned beef sunt ball tip, qui bresaola enim jowl. Capicola short ribs minim salami nulla nostrud pastrami.</p>
        </div>
        <div class="col-lg-4 columns">
            <img src="http://placehold.it/400x300">
        </div>

        <br>

        <div class="col-lg-4 columns" align="left">
            <img src="http://placehold.it/400x300">
        </div>
        <div class="col-lg-8 columns" align="right">
            <h4>This is a content section.</h4>
            <p>Bacon ipsum dolor sit amet nulla ham qui sint exercitation eiusmod commodo, chuck duis velit. Aute in reprehenderit, dolore aliqua non est magna in labore pig pork biltong. Eiusmod swine spare ribs reprehenderit culpa. Boudin aliqua adipisicing rump corned beef.</p>
            <p>Pork drumstick turkey fugiat. Tri-tip elit turducken pork chop in. Swine short ribs meatball irure bacon nulla pork belly cupidatat meatloaf cow. Nulla corned beef sunt ball tip, qui bresaola enim jowl. Capicola short ribs minim salami nulla nostrud pastrami.</p>
        </div>

    </div>

    <br>
    <br>
    <br>
    <div align="center">
        <form class="form-inline" data-wow-offset="0">
            <div class="form-group">
                <a target="_blank" href="" class="btn btn-primary">Quiero conocer al emprendedor</a>
            </div>
        </form>

    </div>

</div>