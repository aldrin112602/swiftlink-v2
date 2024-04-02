<style>


#loader-container {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 9999;
    display: none;
    justify-content: center;
    align-items: center;
}

.loader-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.8);
    cursor: progress;
    z-index: -1;
    
}




.loader {
  --s: 20px;
  
  --_d: calc(0.353*var(--s));
  width: calc(var(--s) + var(--_d));
  aspect-ratio: 1;
  display: grid;
}
.loader:before,
.loader:after {
  content: "";
  grid-area: 1/1;
  clip-path: polygon(var(--_d) 0,100% 0,100% calc(100% - var(--_d)),calc(100% - var(--_d)) 100%,0 100%,0 var(--_d));
  background:
    conic-gradient(from -90deg at calc(100% - var(--_d)) var(--_d),
     #fff 135deg,#666 0 270deg,#aaa 0);
  animation: l6 0.5s infinite;
}
.loader:after {
  animation-delay:-0.3s;
}
@keyframes l6{
  0%  {transform:translate(0,0)}
  25% {transform:translate(30px,0)}
  50% {transform:translate(30px,30px)}
  75% {transform:translate(0,30px)}
  100%{transform:translate(0,0)}
}
</style>

<div id="loader-container" class="align-items-center justify-content-center">
    <div class="loader-overlay"></div>
    <div class="loader"></div>
    <!-- <span class="text-dark">Please wait..</span> -->
</div>

<script>
  const loader_con = document.getElementById('loader-container')
  $('#loader-container').hide()
</script>