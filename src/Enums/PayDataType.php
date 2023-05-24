<?php

namespace Reprover\Jeepay\Enums;

enum PayDataType: string
{
    case PAY_URL = 'payUrl';

    case FORM = 'form';

    case WXAPP = 'wxapp';

    case ALIAPP = 'aliapp';

    case YSFAPP = 'ysfapp';

    case CODE_URL = 'codeUrl';

    case CODE_IMG_URL = 'codeImgUrl';

    case NONE = 'none';
}