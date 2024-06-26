varying highp vec4 xlv_COLOR1;
varying highp vec4 xlv_TEXCOORD4;
varying highp vec4 xlv_TEXCOORD3;
varying highp vec4 xlv_TEXCOORD2;
varying highp vec4 xlv_COLOR0;
varying highp vec4 xlv_TEXCOORD1;
varying highp vec4 xlv_TEXCOORD0;
uniform sampler2D LightMapLookup;
uniform sampler2D LightMap;
uniform sampler2D StudsMap;
uniform highp vec2 OutlineBrightness;
uniform highp vec4 LightBorder;
uniform highp vec4 LightConfig3;
uniform highp vec4 LightConfig2;
uniform highp vec3 FogColor;
uniform highp vec3 AmbientColor;
uniform highp vec3 Lamp0Color;
uniform highp vec3 Lamp0Dir;
void main ()
{
  highp vec4 oColor0_1;
  highp vec4 studs_2;
  lowp vec4 tmpvar_3;
  tmpvar_3 = texture2D (StudsMap, xlv_TEXCOORD1.xy);
  studs_2 = tmpvar_3;
  highp vec4 tmpvar_4;
  tmpvar_4.xyz = ((xlv_COLOR0.xyz * studs_2.xyz) * 2.0);
  tmpvar_4.w = xlv_COLOR0.w;
  highp vec3 tmpvar_5;
  tmpvar_5 = abs((xlv_TEXCOORD2.xyz - LightConfig2.xyz));
  highp vec3 t_6;
  t_6.x = float((tmpvar_5.x >= LightConfig3.x));
  t_6.y = float((tmpvar_5.y >= LightConfig3.y));
  t_6.z = float((tmpvar_5.z >= LightConfig3.z));
  highp float tmpvar_7;
  tmpvar_7 = min (dot (t_6, vec3(1.0, 1.0, 1.0)), 1.0);
  highp vec4 s1_8;
  highp vec4 s0_9;
  highp vec4 offsets_10;
  lowp vec4 tmpvar_11;
  tmpvar_11 = texture2D (LightMapLookup, xlv_TEXCOORD2.xy);
  offsets_10 = tmpvar_11;
  highp vec2 tmpvar_12;
  tmpvar_12 = (xlv_TEXCOORD2.yz * 0.125);
  highp vec2 tmpvar_13;
  tmpvar_13 = (tmpvar_12 - (tmpvar_12 * tmpvar_7));
  lowp vec4 tmpvar_14;
  highp vec2 P_15;
  P_15 = (tmpvar_13 + offsets_10.xy);
  tmpvar_14 = texture2D (LightMap, P_15);
  s0_9 = tmpvar_14;
  lowp vec4 tmpvar_16;
  highp vec2 P_17;
  P_17 = (tmpvar_13 + offsets_10.zw);
  tmpvar_16 = texture2D (LightMap, P_17);
  s1_8 = tmpvar_16;
  highp vec4 tmpvar_18;
  tmpvar_18 = mix (mix (s0_9, s1_8, vec4(fract((xlv_TEXCOORD2.x * 64.0)))), LightBorder, vec4(tmpvar_7));
  oColor0_1.xyz = ((((AmbientColor + (xlv_COLOR1.xyz * tmpvar_18.w)) + tmpvar_18.xyz) * tmpvar_4.xyz) + (Lamp0Color * ((xlv_COLOR1.w * tmpvar_18.w) * pow (clamp (dot (normalize(xlv_TEXCOORD4.xyz), normalize((-(Lamp0Dir) + normalize(xlv_TEXCOORD3.xyz)))), 0.0, 1.0), xlv_TEXCOORD4.w))));
  oColor0_1.w = tmpvar_4.w;
  highp vec2 tmpvar_19;
  tmpvar_19 = min (xlv_TEXCOORD0.wz, xlv_TEXCOORD1.wz);
  highp float tmpvar_20;
  tmpvar_20 = (min (tmpvar_19.x, tmpvar_19.y) / xlv_TEXCOORD3.w);
  oColor0_1.xyz = (oColor0_1.xyz * min (((min (((xlv_TEXCOORD3.w * OutlineBrightness.x) + OutlineBrightness.y), 1.0) * (1.5 - tmpvar_20)) + tmpvar_20), 1.0));
  oColor0_1.xyz = mix (FogColor, oColor0_1.xyz, vec3(clamp (xlv_TEXCOORD2.w, 0.0, 1.0)));
  gl_FragData[0] = oColor0_1;
}

