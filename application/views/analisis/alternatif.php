<div class="row" id="main">
	<div class="col-md-12">
		<div class="card">
			<div class="card-body">
				<h4 class="card-title text-center">Perbandingan Alternatif</h4>
			</div>
			<!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item" v-for="(alt, i) in alternatifs">
					<a class="nav-link" :class="i === 0 ? 'active' : ''"
						data-toggle="tab" :href="alt.id_tempat_latihan | tabId"
						role="tab">
                        <span class="hidden-sm-up"></span>
                        <span class="hidden-xs-down">{{ alt.nama }}</span>
                    </a>
                </li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content tabcontent-border">
				<div class="tab-pane" v-for="(alt, i) in alternatifs" 
					:id="alt.id_tempat_latihan | tabConId" 
					:class="i === 0 ? 'active' : ''" role="tabpanel">
                    <div class="col-md-6 offset-md-3">
                        <div class="card">
							<h4>
								{{ alt.nama }}
							</h4>
                        </div>
                    </div>
                </div>
            </div>
		</div>
	</div>
</div>

<script src="<?php echo base_url() ?>assets/js/vue.js"></script>
<script src="<?php echo base_url() ?>assets/js/axios.min.js"></script>

<script>
	const main_script = new Vue({
		el: '#main',
		data: {
			alternatifs: []
		},
		filters: {
			tabId: function (val) {
				return `#alt-${val}`
			},
			tabConId: function (val) {
				return `alt-${val}`
			}
		},
		mounted: function () {
			this.getListAlt();
		},
		methods: {
			getListAlt: function () {
				axios.get(server_host + '/api/TempatLatihan/ambilTl')
				.then(res => this.alternatifs = res.data)
				.catch(err => console.error(err));
			}
		}
	})
</script>