					</div>
					<!-- ============================================================== -->
					<!-- End Container fluid  -->
					<!-- ============================================================== -->
					<!-- ============================================================== -->
					<!-- footer -->
					<!-- ============================================================== -->
					<footer class="footer text-center">
						<h5>2019 &copy; STMIK AKAKOM Yogyakarta</h5>
						<h6>Template Copyright</h6>
						All Rights Reserved by Matrix-admin. Designed and Developed by <a href="https://wrappixel.com">WrapPixel</a>.
					</footer>
					<!-- ============================================================== -->
					<!-- End footer -->
					<!-- ============================================================== -->
			</div>
			<!-- ============================================================== -->
			<!-- End Page wrapper  -->
			<!-- ============================================================== -->
	</div>
	<!-- ============================================================== -->
	<!-- End Wrapper -->
	<!-- ============================================================== -->
	<script>
		const store = {
			state: {
				isLoading: true
			},
			setLoadingState (loadingState) {
				this.state.isLoading = loadingState;
			},
			getLoadingState () {
				return this.state.isLoading;
			} 
		}

		const loading_control = new Vue({
			el: '#spin',
			data: {
				isLoading: true
			},
			created: function() {
				this.getLoadingState();
			},
			methods: {
				getLoadingState: function () {
					this.isLoading = store.getLoadingState();
				}
			}
		})

		const auth_script = new Vue({
			el: '#user-man',
			data: {
				user: {}
			},
			created: function () {
				this.checkAuth();
			},
			methods: {
				checkAuth: function () {
					this.user = JSON.parse(sessionStorage.getItem('auth_spk_tkwd'));
					if (this.user === null) {
						window.location.assign(server_host + '/Login');
					}

					store.setLoadingState(false);
					loading_control.getLoadingState();
				},
				logout: function () {
					sessionStorage.removeItem('auth_spk_tkwd');
					this.checkAuth();
				}
			}
		})

		const menu_script = new Vue({
			el: '#sidebarnav',
			data: {
				disabledClass: 'disabled-link'
			},
			created: function () {
				this.checkLevel();
			},
			methods: {
				checkLevel: function () {
					const level = JSON.parse(sessionStorage.getItem('auth_spk_tkwd')).level;
					if (level === 'user') {
						this.disabledClass = 'disabled-link';
					} else {
						this.disabledClass = '';
					}
				}
			} 
		})
	</script>
	
</body>

</html>