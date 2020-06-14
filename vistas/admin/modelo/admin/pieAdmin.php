
                </div>

            </div>

            <footer class="py-5">
        
                <div class="container">
                
                    <p class="m-0 text-center text-secondary">Copyright &copy; <?php echo ((isset($tienda))? $tienda:'NombreTienda'); ?> </p>
                
                </div>

            </footer>

        </div>
        <!-- /#page-content-wrapper -->

    </div>

<!-- Menu Toggle Script -->

<script>

    $("#menu-toggle").click(function(e) {

      e.preventDefault();
      $("#wrapper").toggleClass("toggled");

    });

</script>