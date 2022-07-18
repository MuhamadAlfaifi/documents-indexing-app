@props(['name' => 'date', 'selectedDate' => '2021-02-04'])

<div id="flatpicker-host"></div>

<script>
  flatpickr("#flatpicker-host", {
    enableTime: true,
    dateFormat: "Y-m-d H:i",
  });
</script>