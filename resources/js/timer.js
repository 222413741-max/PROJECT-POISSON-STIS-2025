startTimer = function (duration, display) {
  let timer = duration,
    hours,
    minutes,
    seconds;
  setInterval(function () {
    hours = parseInt(timer / 3600, 10);
    minutes = parseInt((timer / 60) % 60, 10);
    seconds = parseInt(timer % 60, 10);

    minutes = minutes < 10 ? "0" + minutes : minutes;
    seconds = seconds < 10 ? "0" + seconds : seconds;

    display.textContent = `${hours}:${minutes}:${seconds}`;

    if (--timer < 0) {
      timer = 0;
    }
  }, 1000);
};

Livewire.on("timer", (timer) => {
  startTimer(timer, document.getElementById("timer"));
});
