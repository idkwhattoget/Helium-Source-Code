varying vec3 xlv_TEXCOORD6;
varying vec4 xlv_TEXCOORD4;
varying vec4 xlv_TEXCOORD3;
varying vec4 xlv_TEXCOORD2;
varying vec4 xlv_COLOR0;
varying vec4 xlv_TEXCOORD1;
varying vec4 xlv_TEXCOORD0;
uniform sampler2D SpecularMap;
uniform sampler2D NormalMap;
uniform sampler2D DiffuseMap;
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
  vec3 albedo_4;
  vec3 normal_5;
  vec4 diffuse_6;
  vec4 tmpvar_7;
  tmpvar_7 = texture2D (DiffuseMap, xlv_TEXCOORD0.xy);
  diffuse_6.w = tmpvar_7.w;
  diffuse_6.xyz = mix (vec3(1.0, 1.0, 1.0), tmpvar_7.xyz, vec3(tmpvar_3));
  vec2 tmpvar_8;
  tmpvar_8 = ((texture2D (NormalMap, xlv_TEXCOORD0.xy).wy * 2.0) - 1.0);
  vec3 tmpvar_9;
  tmpvar_9.xy = tmpvar_8;
  tmpvar_9.z = sqrt(clamp ((1.0 + dot (-(tmpvar_8), tmpvar_8)), 0.0, 1.0));
  normal_5.z = tmpvar_9.z;
  normal_5.xy = (tmpvar_8 * tmpvar_3);
  albedo_4 = ((xlv_COLOR0.xyz * diffuse_6.xyz) * (texture2D (StudsMap, xlv_TEXCOORD1.xy).xyz * 2.0));
  vec2 tmpvar_10;
  tmpvar_10 = mix (vec2(0.07, 6.0), ((texture2D (SpecularMap, xlv_TEXCOORD0.xy).xy * vec2(0.4, 32.0)) + vec2(0.0, 0.01)), vec2(tmpvar_3));
  vec4 tmpvar_11;
  tmpvar_11.xyz = albedo_4;
  tmpvar_11.w = xlv_COLOR0.w;
  albedo_2.w = tmpvar_11.w;
  vec3 tmpvar_12;
  tmpvar_12 = normalize((((normal_5.x * xlv_TEXCOORD6) + (normal_5.y * ((xlv_TEXCOORD4.yzx * xlv_TEXCOORD6.zxy) - (xlv_TEXCOORD4.zxy * xlv_TEXCOORD6.yzx)))) + (tmpvar_9.z * xlv_TEXCOORD4.xyz)));
  float tmpvar_13;
  tmpvar_13 = dot (tmpvar_12, -(Lamp0Dir));
  vec3 tmpvar_14;
  tmpvar_14 = abs((xlv_TEXCOORD2.xyz - LightConfig2.xyz));
  vec3 t_15;
  t_15.x = float((tmpvar_14.x >= LightConfig3.x));
  t_15.y = float((tmpvar_14.y >= LightConfig3.y));
  t_15.z = float((tmpvar_14.z >= LightConfig3.z));
  float tmpvar_16;
  tmpvar_16 = clamp (dot (t_15, vec3(1.0, 1.0, 1.0)), 0.0, 1.0);
  vec4 tmpvar_17;
  tmpvar_17 = mix (texture3D (LightMap, (xlv_TEXCOORD2.yzx - (xlv_TEXCOORD2.yzx * tmpvar_16))), LightBorder, vec4(tmpvar_16));
  albedo_2.xyz = albedo_4;
  oColor0_1.xyz = ((((AmbientColor + (((clamp (tmpvar_13, 0.0, 1.0) * Lamp0Color) + (max (-(tmpvar_13), 0.0) * Lamp1Color)) * tmpvar_17.w)) + tmpvar_17.xyz) * albedo_4) + (Lamp0Color * (((float((tmpvar_13 >= 0.0)) * tmpvar_10.x) * tmpvar_17.w) * pow (clamp (dot (tmpvar_12, normalize((-(Lamp0Dir) + normalize(xlv_TEXCOORD3.xyz)))), 0.0, 1.0), tmpvar_10.y))));
  oColor0_1.w = albedo_2.w;
  vec2 tmpvar_18;
  tmpvar_18 = min (xlv_TEXCOORD0.wz, xlv_TEXCOORD1.wz);
  float tmpvar_19;
  tmpvar_19 = (min (tmpvar_18.x, tmpvar_18.y) / xlv_TEXCOORD3.w);
  oColor0_1.xyz = (oColor0_1.xyz * clamp (((clamp (((xlv_TEXCOORD3.w * OutlineBrightness.x) + OutlineBrightness.y), 0.0, 1.0) * (1.5 - tmpvar_19)) + tmpvar_19), 0.0, 1.0));
  oColor0_1.xyz = mix (FogColor, oColor0_1.xyz, vec3(clamp (xlv_TEXCOORD2.w, 0.0, 1.0)));
  gl_FragData[0] = oColor0_1;
}

