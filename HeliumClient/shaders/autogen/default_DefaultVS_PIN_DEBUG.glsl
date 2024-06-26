varying vec4 xlv_COLOR1;
varying vec4 xlv_TEXCOORD2;
varying vec4 xlv_COLOR0;
varying vec4 xlv_TEXCOORD1;
varying vec4 xlv_TEXCOORD0;
attribute vec4 secondary_colour;
attribute vec2 uv1;
attribute vec2 uv0;
attribute vec3 normal;
attribute vec4 vertex;
uniform vec4 DebugColor;
uniform vec4 LightConfig1;
uniform vec4 LightConfig0;
uniform vec4 FogParams;
uniform vec3 Lamp1Color;
uniform vec3 Lamp0Color;
uniform vec3 Lamp0Dir;
uniform mat4 ViewProjection;
uniform vec3 CameraPosition;
void main ()
{
  vec4 tmpvar_1;
  vec4 tmpvar_2;
  tmpvar_1.zw = vec2(0.0, 0.0);
  tmpvar_2.zw = vec2(0.0, 0.0);
  float tmpvar_3;
  tmpvar_3 = dot (normal, -(Lamp0Dir));
  vec4 tmpvar_4;
  tmpvar_4.xw = vec2(1.0, 1.0);
  tmpvar_4.y = max (0.0, tmpvar_3);
  tmpvar_4.z = pow ((max (0.0, dot (normalize((-(Lamp0Dir) + normalize((CameraPosition - vertex.xyz)))), normal)) * float((tmpvar_3 >= 0.0))), secondary_colour.z);
  vec4 tmpvar_5;
  tmpvar_5.w = 1.0;
  tmpvar_5.xyz = vertex.xyz;
  vec4 tmpvar_6;
  tmpvar_6 = (ViewProjection * tmpvar_5);
  tmpvar_1.xy = uv0;
  tmpvar_2.xy = uv1;
  vec4 tmpvar_7;
  tmpvar_7.xyz = (((vertex.xyz + (normal * 6.0)).yxz * LightConfig0.xyz) + LightConfig1.xyz);
  tmpvar_7.w = ((FogParams.z - tmpvar_6.w) * FogParams.w);
  vec4 tmpvar_8;
  tmpvar_8.xyz = ((tmpvar_4.y * Lamp0Color) + (max (-(tmpvar_3), 0.0) * Lamp1Color));
  tmpvar_8.w = (tmpvar_4.z * (secondary_colour.y / 255.0));
  gl_Position = tmpvar_6;
  xlv_TEXCOORD0 = tmpvar_1;
  xlv_TEXCOORD1 = tmpvar_2;
  xlv_COLOR0 = DebugColor;
  xlv_TEXCOORD2 = tmpvar_7;
  xlv_COLOR1 = tmpvar_8;
}

