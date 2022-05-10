
     <!-- SCRIPTS -->
     <script src="admin/js/jquery.js"></script>
     <script src="admin/js/bootstrap.min.js"></script>
     <script src="admin/js/owl.carousel.min.js"></script>
     <script src="admin/js/smoothscroll.js"></script>
     <script src="admin/js/custom.js"></script>
     <script
   type="text/javascript"></script>
   <script type="text/javascript" src="ckeditor/ckeditor.js"></script>
   <script>
   // Replace the <textarea id="editor1"> with a CKEditor
   // instance, using default configuration.
   CKEDITOR.replace('detail');
   function CKupdate() {
       for (instance in CKEDITOR.instances)
           CKEDITOR.instances[instance].updateElement();
   }
</script>

     </body>
</html>
