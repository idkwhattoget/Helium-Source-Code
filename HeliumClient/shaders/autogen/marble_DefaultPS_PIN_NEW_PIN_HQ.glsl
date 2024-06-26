varying vec4 xlv_TEXCOORD4;
varying vec4 xlv_TEXCOORD3;
varying vec4 xlv_TEXCOORD2;
varying vec4 xlv_COLOR0;
varying vec4 xlv_TEXCOORD1;
varying vec4 xlv_TEXCOORD0;
uniform sampler2D SpecularMap;
uniform samplerCube EnvironmentMap;
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
  vec4 diffuse_5;
  vec4 tmpvar_6;
  tmpvar_6 = texture2D (DiffuseMap, xlv_TEXCOORD0.xy);
  diffuse_5.w = tmpvar_6.w;
  diffuse_5.xyz = mix (vec3(1.0, 1.0, 1.0), tmpvar_6.xyz, vec3(tmpvar_3));
  albedo_4 = ((xlv_COLOR0.xyz * diffuse_5.xyz) * (texture2D (StudsMap, xlv_TEXCOORD1.xy).xyz * 2.0));
  vec4 tmpvar_7;
  tmpvar_7 = texture2D (SpecularMap, xlv_TEXCOORD0.xy);
  vec2 tmpvar_8;
  tmpvar_8 = mix (vec2(0.7, 54.0), ((tmpvar_7.xy * vec2(1.0, 128.0)) + vec2(0.0, 0.01)), vec2(tmpvar_3));
  vec4 tmpvar_9;
  tmpvar_9.xyz = albedo_4;
  tmpvar_9.w = xlv_COLOR0.w;
  albedo_2.w = tmpvar_9.w;
  vec3 tmpvar_10;
  tmpvar_10 = normalize(xlv_TEXCOORD4.xyz);
  float tmpvar_11;
  tmpvar_11 = dot (tmpvar_10, -(Lamp0Dir));
  vec3 tmpvar_12;
  tmpvar_12 = abs((xlv_TEXCOORD2.xyz - LightConfig2.xyz));
  vec3 t_13;
  t_13.x = float((tmpvar_12.x >= LightConfig3.x));
  t_13.y = float((tmpvar_12.y >= LightConfig3.y));
  t_13.z = float((tmpvar_12.z >= LightConfig3.z));
  float tmpvar_14;
  tmpvar_14 = clamp (dot (t_13, vec3(1.0, 1.0, 1.0)), 0.0, 1.0);
  vec4 tmpvar_15;
  tmpvar_15 = mix (texture3D (LightMap, (xlv_TEXCOORD2.yzx - (xlv_TEXCOORD2.yzx * tmpvar_14))), LightBorder, vec4(tmpvar_14));
  vec3 i_16;
  i_16 = -(xlv_TEXCOORD3.xyz);
  albedo_2.xyz = mix (albedo_4, textureCube (EnvironmentMap, (i_16 - (2.0 * (dot (tmpvar_10, i_16) * tmpvar_10)))).xyz, vec3(((tmpvar_7.y * tmpvar_3) * 0.2)));
  oColor0_1.xyz = ((((AmbientColor + (((clamp (tmpvar_11, 0.0, 1.0) * Lamp0Color) + (max (-(tmpvar_11), 0.0) * Lamp1Color)) * tmpvar_15.w)) + tmpvar_15.xyz) * albedo_2.xyz) + (Lamp0Color * (((float((tmpvar_11 >= 0.0)) * tmpvar_8.x) * tmpvar_15.w) * pow (clamp (dot (tmpvar_10, normalize((-(Lamp0Dir) + normalize(xlv_TEXCOORD3.xyz)))), 0.0, 1.0), tmpvar_8.y))));
  oColor0_1.w = albedo_2.w;
  vec2 tmpvar_17;
  tmpvar_17 = min (xlv_TEXCOORD0.wz, xlv_TEXCOORD1.wz);
  float tmpvar_18;
  tmpvar_18 = (min (tmpvar_17.x, tmpvar_17.y) / xlv_TEXCOORD3.w);
  oColor0_1.xyz = (oColor0_1.xyz * clamp (((clamp (((xlv_TEXCOORD3.w * OutlineBrightness.x) + OutlineBrightness.y), 0.0, 1.0) * (1.5 - tmpvar_18)) + tmpvar_18), 0.0, 1.0));
  oColor0_1.xyz = mix (FogColor, oColor0_1.xyz, vec3(clamp (xlv_TEXCOORD2.w, 0.0, 1.0)));
  gl_FragData[0] = oColor0_1;
}

