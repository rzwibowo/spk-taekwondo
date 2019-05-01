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
					if ((this.user === null) || (!this.user.token)) {
						window.location.assign(server_host + '/Login');
					}
				},
				logout: function () {
					sessionStorage.removeItem('auth_spk_tkwd');
					this.checkAuth();
				}
			}
		})
	</script>
	
</body>

</html>