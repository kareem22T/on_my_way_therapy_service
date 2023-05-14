<div class="loader">
    <div class="spinner lds-ring">
    </div>    
</div>

<style>
.loader {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    background: #0000009e;
    z-index: 22222222222222222222222222222;
    display: none
}
.spinner {
   position: relative;
   width: 56px;
   height: 56px;
   animation: spinner-xza56z 2s infinite linear;
}

.spinner::before,
.spinner::after {
   content: '';
   position: absolute;
   top: 50%;
   left: 50%;
   background: #ffc400;
   border-radius: 50%;
   animation: spinner-lqsq3g 1.25s infinite ease;
}

.spinner::before {
   height: 75%;
   width: 75%;
   transform-origin: -40% -80%;
}

.spinner::after {
   height: 50%;
   width: 50%;
   transform-origin: 40% 80%;
}

@keyframes spinner-xza56z {
   to {
      transform: rotate(360deg);
   }
}

@keyframes spinner-lqsq3g {
   0%, 100% {
      transform: translate(-50%, -50%) scale(1);
   }

   50% {
      transform: translate(-50%, -50%) scale(0);
   }
}
</style>