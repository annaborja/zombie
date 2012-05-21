window.onload = function()
{
    var canvas = document.getElementById('canvas');
    var context = canvas.getContext('2d');
    drawCheckerboard(401, 401, context);
};

function drawRow(y, width, context)
{
    if (y <= 0)
        return;
    else
    {
        context.beginPath();
        context.moveTo(0, y);
        context.lineTo(width, y);
        context.stroke();
        return drawRow(y - 20, width, context);
    }
}

function drawColumn(x, height, context)
{
    if (x <= 0)
        return;
    else
    {
        context.beginPath();
        context.moveTo(x, 0);
        context.lineTo(x, height);
        context.stroke();
        return drawColumn(x - 20, height, context);
    }
}

function drawCheckerboard(width, height, context)
{
    drawRow(height, width, context);
    drawColumn(width, height, context);
}
