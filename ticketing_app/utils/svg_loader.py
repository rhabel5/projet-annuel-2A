import cairosvg

def load_svg(file_path, size=(24, 24)):
    return cairosvg.svg2png(url=file_path, output_width=size[0], output_height=size[1])