<crm-angular-js modules="hvaddrdialog">
  <div class="addrvirtualcontainer">
    <button name="show_hvaddr" type="button" hvaddr-dialog-popup="hvaddrdialog" title="Fenêtre de saisie de l'adresse">Assistant Saisie de l'adresse</button>
  </div>
  <script type="text/javascript">
    CRM.$("div.addrvirtualcontainer").on("hvaddrdialog", function (event, data) {
      console.log("hvaddrDialogPopup");
      console.log(data);
      window.alert(JSON.stringify(data));
    });
  </script>
</crm-angular-js>
