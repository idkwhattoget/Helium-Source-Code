varying vec3 xlv_TEXCOORD6;
varying vec4 xlv_TEXCOORD5;
varying vec4 xlv_TEXCOORD4;
varying vec4 xlv_TEXCOORD3;
varying vec4 xlv_TEXCOORD2;
varying vec4 xlv_COLOR0;
varying vec4 xlv_TEXCOORD1;
varying vec4 xlv_TEXCOORD0;
uniform sampler3D NoiseMap;
uniform samplerCube EnvironmentMap;
uniform sampler2D NormalMap;
uniform sampler3D LightMap;
uniform sampler2D StudsMap;
uniform vec2 OutlineBrightness;
uniform vec4 LightBorder;
uniform vec4 LightConfig3;
uniform vec4 LightConfig2;
uniform vec3 FogColor;
uniform vec3 AmbientColor;
uniform vec3 Lamp1Color;
uniform vec3 Lamp0Color;
uniform vec3 Lamp0Dir;
void main ()
{
  vec4 oColor0_1;
  vec4 albedo_2;
  float tmpvar_3;
  tmpvar_3 = clamp ((1.0 - xlv_TEXCOORD3.w), 0.0, 1.0);
  vec3 tNorm_4;
  vec3 tmpvar_5;
  tmpvar_5 = (texture2D (NormalMap, (xlv_TEXCOORD0.xy * 0.01)).xyz - vec3(0.5, 0.5, 0.5));
  tNorm_4.z = tmpvar_5.z;
  tNorm_4.xy = (tmpvar_5.xy * (0.15 * tmpvar_3));
  vec4 tmpvar_6;
  tmpvar_6.w = 0.0;
  tmpvar_6.xyz = ((xlv_COLOR0.xyz + (((texture3D (NoiseMap, ((xlv_TEXCOORD5.xyz / 2.33333) * 0.1)).xyz * ((texture3D (NoiseMap, ((xlv_TEXCOORD5.xyz / 2.33333) * 0.5)).xyz * 0.7) + 0.5)) * 0.35) - 0.15)) * (0.85 + (0.15 * dot (tmpvar_5, vec3(1.0, 1.0, 1.0)))));
  vec4 tmpvar_7;
  tmpvar_7 = texture2D (StudsMap, xlv_TEXCOORD1.xy);
  vec4 tmpvar_8;
  tmpvar_8.xyz = mix (mix (xlv_COLOR0, tmpvar_6, vec4(tmpvar_3)).xyz, tmpvar_7.xyz, tmpvar_7.www);
  tmpvar_8.w = xlv_COLOR0.w;
  albedo_2.w = tmpvar_8.w;
  vec3 tmpvar_9;
  tmpvar_9 = normalize((((tNorm_4.x * xlv_TEXCOORD6) + (tNorm_4.y * ((xlv_TEXCOORD4.yzx * xlv_TEXCOORD6.zxy) - (xlv_TEXCOORD4.zxy * xlv_TEXCOORD6.yzx)))) + (tmpvar_5.z * xlv_TEXCOORD4.xyz)));
  float tmpvar_10;
  tmpvar_10 = dot (tmpvar_9, -(Lamp0Dir));
  vec3 tmpvar_11;
  tmpvar_11 = abs((xlv_TEXCOORD2.xyz - LightConfig2.xyz));
  vec3 t_12;
  t_12.x = float((tmpvar_11.x >= LightConfig3.x));
  t_12.y = float((tmpvar_11.y >= LightConfig3.y));
  t_12.z = float((tmpvar_11.z >= LightConfig3.z));
  float tmpvar_13;
  tmpvar_13 = clamp (dot (t_12, vec3(1.0, 1.0, 1.0)), 0.0, 1.0);
  vec4 tmpvar_14;
  tmpvar_14 = mix (texture3D (LightMap, (xlv_TEXCOORD2.yzx - (xlv_TEXCOORD2.yzx * tmpvar_13))), LightBorder, vec4(tmpvar_13));
  vec3 i_15;
  i_15 = -(xlv_TEXCOORD3.xyz);
  albedo_2.xyz = mix (tmpvar_8.xyz, textureCube (EnvironmentMap, (i_15 - (2.0 * (dot (tmpvar_9, i_15) * tmpvar_9)))).xyz, vec3((0.275 * tmpvar_3)));
  oColor0_1.xyz = ((((AmbientColor + (((clamp (tmpvar_10, 0.0, 1.0) * Lamp0Color) + (max (-(tmpvar_10), 0.0) * Lamp1Color)) * tmpvar_14.w)) + tmpvar_14.xyz) * albedo_2.xyz) + (Lamp0Color * (((float((tmpvar_10 >= 0.0)) * 0.4) * tmpvar_14.w) * pow (clamp (dot (tmpvar_9, normalize((-(Lamp0Dir) + normalize(xlv_TEXCOORD3.xyz)))), 0.0, 1.0), 50.0))));
  oColor0_1.w = albedo_2.w;
  vec2 tmpvar_16;
  tmpvar_16 = min (xlv_TEXCOORD0.wz, xlv_TEXCOORD1.wz);
  float tmpvar_17;
  tmpvar_17 = (min (tmpvar_16.x, tmpvar_16.y) / xlv_TEXCOORD3.w);
  oColor0_1.xyz = (oColor0_1.xyz * clamp (((clamp (((xlv_TEXCOORD3.w * OutlineBrightness.x) + OutlineBrightness.y), 0.0, 1.0) * (1.5 - tmpvar_17)) + tmpvar_17), 0.0, 1.0));
  oColor0_1.xyz = mix (FogColor, oColor0_1.xyz, vec3(clamp (xlv_TEXCOORD2.w, 0.0, 1.0)));
  gl_FragData[0] = oColor0_1;
}

