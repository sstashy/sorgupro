<script>

    function datatbTemizle() {
        $('#tcInput').val("");
        $('#sonuc').html('<td valign="top" colspan="10" class="dataTables_empty"></td>');
        showAlert("Başarıyla temizlendi.", "success");
    }

    function kontrolEt() {
        checkRow('tcInput');
        $.ajax({
            url: "api/asi/api.php",
            type: "POST",
            data: {
                tc: $('#tcInput').val(),
            },
            success: (res) => {
                if(res) {
                    hideToast();
                    showAlert("Sonuç bulundu.", "success");
                    let array = [];
                    let data = res.AsiUygulamaSorgulamaDetayListesi;

                    data.forEach(xd => {

                        let tc = $('#tcInput').val();
                        let birim = xd.Birim || "Bulunamadı";
                        let dg = xd.DogumTarih || "Bulunamadı";
                        let hekimtc = xd.HekimKimlikNo || "Bulunamadı";
                        let UrunTanimi = xd.UrunTanimi || "Bulunamadı";
                        var result = `<tr>
                            <td>${tc}</td>
                            <td>${birim}</td>
                            <td>${dg}</td>
                            <td>${hekimtc}</td>
                            <td>${UrunTanimi}</td>
                        </tr>`
                        array.push(result);
                    });
                    $('#sonuc').html(array);

                } else {
                    hideToast();
                    showAlert("Bir sonuç bulunamadı!", "danger");
                }
            },
            error: (res) => {
                hideToast();
                showAlert("Bir sonuç bulunamadı.", "danger");
            }
        })
    }
</script>