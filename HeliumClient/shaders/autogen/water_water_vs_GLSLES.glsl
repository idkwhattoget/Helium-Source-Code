varying highp vec2 xlv_TEXCOORD4;
varying highp vec3 xlv_TEXCOORD3;
varying highp vec3 xlv_TEXCOORD2;
varying highp vec4 xlv_TEXCOORD1;
varying highp vec3 xlv_TEXCOORD0;
attribute vec3 normal;
attribute vec4 vertex;
uniform highp vec2 FadeDistance;
uniform highp vec3 Lamp0Dir;
uniform highp vec4 LightConfig1;
uniform highp vec4 LightConfig0;
uniform highp vec4 FogParams;
uniform highp vec4 CameraPosition;
uniform highp vec4 waveParams;
uniform highp mat4 ViewProjection;
uniform highp mat4 World;
void main ()
{
  highp vec2 tcselect_1;
  highp vec4 wspos_2;
  highp vec3 tmpvar_3;
  highp vec3 tmpvar_4;
  highp vec2 tmpvar_5;
  highp vec3 tmpvar_6;
  tmpvar_6 = normalize(((normal - 127.0) / 127.0));
  highp vec4 tmpvar_7;
  tmpvar_7 = (World * vertex);
  wspos_2.xzw = tmpvar_7.xzw;
  wspos_2.y = (tmpvar_7.y - (2.0 * waveParams.z));
  tmpvar_4 = tmpvar_6;
  if ((tmpvar_6.y < 0.01)) {
    tmpvar_4 = tmpvar_6;
  };
  highp vec3 tmpvar_8;
  tmpvar_8.x = wspos_2.x;
  tmpvar_8.y = -(wspos_2.y);
  tmpvar_8.z = wspos_2.z;
  tcselect_1.x = dot (abs(tmpvar_6.yxz), tmpvar_7.xzx);
  tcselect_1.y = dot (abs(tmpvar_6.yxz), tmpvar_8.zyy);
  highp vec4 tmpvar_9;
  tmpvar_9 = (ViewProjection * wspos_2);
  tmpvar_3.xy = (tcselect_1 * 0.05);
  tmpvar_3.z = clamp (((FogParams.z - tmpvar_9.w) * FogParams.w), 0.0, 1.0);
  highp vec3 arg0_10;
  arg0_10 = (CameraPosition.xyz - wspos_2.xyz);
  tmpvar_5.x = clamp ((-0.4 + ((1.4 * sqrt(dot (arg0_10, arg0_10))) * FadeDistance.y)), 0.0, 1.0);
  tmpvar_5.y = (((1.0 - tmpvar_5.x) * clamp (dot (tmpvar_6, -(Lamp0Dir)), 0.0, 1.0)) * 100.0);
  gl_Position = tmpvar_9;
  xlv_TEXCOORD0 = tmpvar_3;
  xlv_TEXCOORD1 = wspos_2;
  xlv_TEXCOORD2 = tmpvar_4;
  xlv_TEXCOORD3 = (((wspos_2.xyz + (tmpvar_6 * 6.0)).yxz * LightConfig0.xyz) + LightConfig1.xyz);
  xlv_TEXCOORD4 = tmpvar_5;
}

