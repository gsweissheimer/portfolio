<!-- Start Banner =====================
	======================================= -->
    <?php $this->load->view('blog/bannerDetail'); ?>
	<!-- ==================================
	============================ End Banner -->
	<!-- Start two ========================
	======================================= -->
    <?php $this->load->view('blog/twoDetail');?>
	<!-- ==================================
    =============================== End two -->
	<!-- Start three ======================
	======================================= -->
    <?php /*/$this->load->view('blog/three');*/ ?>
	<!-- ==================================
    ============================= End three -->
	<!-- Start four =======================
	======================================= -->
    <?php /*$this->load->view('blog/four');*/ ?>
	<!-- ==================================
    ============================== End four -->
	<!-- Start five =======================
	======================================= -->
    <?php $this->load->view('blog/five'); ?>
	<!-- ==================================
    ============================== End five -->


<script>

	/*let iframes = [...document.getElementById('videOwl').querySelectorAll('.item iframe')]

	iframes.map((e,i) => {

	let aux = e.dataset.src.split('=')

	aux.shift()

	if(aux.length > 1) {

		aux = aux[0].split('&')[0];

	}

	let baseUrl = 'https://www.youtube.com/embed/'

	e.src = baseUrl + aux

	let widthAux = (window.outerWidth - 40)

	e.style.width = widthAux + "px"

	e.style.height = (widthAux * 0.5625 ) + "px"

	})*/

</script>
	