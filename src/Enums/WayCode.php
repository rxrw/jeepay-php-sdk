<?php

namespace Reprover\Jeepay\caseants;

enum WayCode: string
{
  case QR_CASHIER = 'QR_CASHIER';
  case AUTO_BAR = 'AUTO_BAR';

  case ALI_BAR = 'ALI_BAR';
  case ALI_JSAPI = 'ALI_JSAPI';
  case ALI_APP = 'ALI_APP';
  case ALI_WAP = 'ALI_WAP';
  case ALI_PC = 'ALI_PC';
  case ALI_QR = 'ALI_QR';

  case WX_BAR = 'WX_BAR';
  case WX_JSAPI = 'WX_JSAPI';
  case WX_LITE = 'WX_LITE';
  case WX_APP = 'WX_APP';
  case WX_H5 = 'WX_H5';
  case WX_NATIVE = 'WX_NATIVE';

  case YSF_BAR = 'YSF_BAR';
  case YSF_JSAPI = 'YSF_JSAPI';
}
