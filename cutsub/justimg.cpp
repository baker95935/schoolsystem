// quzao.cpp : ∂®“Âøÿ÷∆Ã®”¶”√≥Ã–Úµƒ»Îø⁄µ„°£
//

//#include "stdafx.h"

#include <opencv2/core/core.hpp>
#include <opencv2/objdetect/objdetect.hpp>
#include <opencv2/highgui/highgui.hpp>
#include <opencv2/imgproc/imgproc.hpp>

#include  <iostream>
#include  <math.h>
#include  <ctime>
#include  <time.h>
#include  <string>
#include  <vector>
#include <iomanip>
#include <string>
#include <cstdio>

using namespace cv;
using namespace std;

#define pi 3.1415926

bool  rotatesub(string address, double angle)
{
    Mat rotMat(2, 3, CV_32FC1);
    Mat src = cv::imread(address);
    double x = 0.5*src.cols;
    double y = 0.5*src.rows;
    double z = sqrt(x*x + y*y);
    double t1 = atan(y / x) - fabs(angle) / 180 * pi;
    double t2 = atan(x / y) - fabs(angle) / 180 * pi;
    double r_x = cos(t1)*z;
    double r_y = cos(t2)*z;
    
    Mat temp2 = Mat(int(2 * r_y), int(2 * r_x), src.type(), Scalar(255, 255, 255));
    Mat imageROI = temp2(Rect(int(r_x - 0.5*src.cols), int(r_y - 0.5*src.rows), src.cols, src.rows));
    addWeighted(imageROI, 0, src, 1, 0., imageROI);
    Point center = Point(temp2.cols / 2, temp2.rows / 2);
    double scale = 1;
    rotMat = getRotationMatrix2D(center, angle, scale);
    Mat dst = Mat(temp2.cols, temp2.rows, temp2.type(), Scalar(255, 255, 255));;
    warpAffine(temp2, dst, rotMat, temp2.size(), INTER_LINEAR, BORDER_CONSTANT, Scalar(255, 255, 255));
    return imwrite("/Users/fangzheng/Desktop/1232/mmk.jpg", dst);
}


int main(int argc,char** argv)
{
    Mat srcimg;
    Mat bwimg;
    Mat resimg;
//    if(argc!=2)
//    {
//        exit(0);
//    }
    string address="/Users/fangzheng/Desktop/1232/20180525.jpg";
    
   // string address=argv[1];
    srcimg=imread(address,0);
    threshold(srcimg,bwimg,140,255,CV_THRESH_BINARY_INV);
    
    
    vector<vector<Point>>contour;//”√¿¥¥¢¥Ê¬÷¿™
    vector<Vec4i>hierarchy;
    
    findContours(bwimg, contour, hierarchy, RETR_EXTERNAL, CHAIN_APPROX_SIMPLE);
    
//    int count=0;
    
    RNG g_rng(12345);
//    int g_nElementShape=MORPH_RECT;
    Mat drawing = Mat::zeros(srcimg.size(), CV_8UC3);
    srcimg.copyTo(drawing);
    double m_maxarea=0;
    int m_maxindex=0;
    for (int unsigned i = 0; i < contour.size(); i++)
    {
        double m_temp=contourArea(contour[i]);
        if (m_temp>m_maxarea)
        {
            m_maxarea=m_temp;
            m_maxindex=i;
            continue;
        }
        
    }
    CvBox2D   End_Rage2D = minAreaRect(contour.at(m_maxindex));
    double angle=End_Rage2D.angle;
    cout<<angle<<endl;
    if(-90.00<=angle && angle<=-45.00)
    {
        angle=angle+90;
        rotatesub(address,angle);
        return 0;
    }

    if(-45.00<angle  && angle<0)
    {
        angle=angle;
        rotatesub(address,angle);
        return 0;
    }
    
    return 0;
}


