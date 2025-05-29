function generateCertificate() {
    const name = document.getElementById('nameInput').value;
    if (!name) {
        alert("Please enter your name!");
        return;
    }

    const canvas = document.getElementById('certificateCanvas');
    const ctx = canvas.getContext('2d');

    // Clear canvas
    ctx.fillStyle = '#ffffff';
    ctx.fillRect(0, 0, canvas.width, canvas.height);

    // Draw border
    ctx.strokeStyle = '#2196f3';
    ctx.lineWidth = 10;
    ctx.strokeRect(20, 20, canvas.width - 40, canvas.height - 40);

    // Title
    ctx.fillStyle = '#d81b60';
    ctx.font = 'bold 40px Arial';
    ctx.textAlign = 'center';
    ctx.fillText('Certificate of Achievement', canvas.width / 2, 100);

    // Name
    ctx.fillStyle = '#333';
    ctx.font = '30px Arial';
    ctx.fillText(`Awarded to: ${name}`, canvas.width / 2, 250);

    // Description
    ctx.font = '20px Arial';
    ctx.fillText('For completing the Test!', canvas.width / 2, 350);

}