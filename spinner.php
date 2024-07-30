<div class="background-loader">
  <div class="loader">
    <span class="spinner spinner1"></span>
    <span class="spinner spinner2"></span>
    <span class="spinner spinner3"></span>
    <br>
    <span class="loader-text">LOADING...</span>
  </div>
</div>
<style>
	HTML CSSResult Skip Results Iframe
body{
  margin: 0;
  min-width: 100%;
  min-height: 100%;
  font-family: Arial;
}

.background-loader{
  position: fixed;
  z-index: 300;
  background-color: #fff;
  width: 100%;
  height: 100%;
}

.loader{
  position: fixed;
  z-index: 301;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  height: 200px;
  width: 200px;
  overflow: hidden;
  text-align: center;
}

.spinner{
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  z-index: 303;
  border-radius: 100%;
  border-left-color: transparent !important;
  border-right-color: transparent !important;
}

.spinner1{
  width: 100px;
  height: 100px;
  border: 10px solid #347769;
  animation: spin 1s linear infinite;
}

.spinner2{
  width: 70px;
  height: 70px;
  border: 10px solid #347769;
  animation: negative-spin 2s linear infinite;
}

.spinner3{
  width: 40px;
  height: 40px;
  border: 10px solid #347769;
  animation: spin 4s linear infinite;
}

@keyframes spin {
  0%{
    transform: translate(-50%,-50%) rotate(0deg);
  }
  100%{
    transform: translate(-50%,-50%) rotate(360deg);
  }
}

@keyframes negative-spin {
  0%{
    transform: translate(-50%,-50%) rotate(0deg);
  }
  100%{
    transform: translate(-50%,-50%) rotate(-360deg);
  }
}

.loader-text {
  position: relative;
  top: 75%;
  color: #fff;
  font-weight: bold;
}



Resources1× 0.5× 0.25×Rerun
</style>