<!DOCTYPE html>
<html>

<head>
    <title>Edit Reward</title>
</head>

<body>

    <h1>Edit Reward</h1>

    <form
        action="{{ route('reward.update',$reward->id) }}"
        method="POST">

        @csrf
        @method('PUT')

        <label>Nama Reward</label>
        <br>

        <input
            type="text"
            name="nama_reward"
            value="{{ $reward->nama_reward }}">

        <br><br>

        <label>Jumlah Koin</label>
        <br>

        <input
            type="number"
            name="jumlah_koin"
            value="{{ $reward->jumlah_koin }}">

        <br><br>

        <label>Stok</label>
        <br>

        <input
            type="number"
            name="stok"
            value="{{ $reward->stok }}">

        <br><br>

        <button type="submit">
            Update
        </button>

    </form>

</body>

</html>