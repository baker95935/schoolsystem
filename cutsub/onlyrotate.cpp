#include  <opencv2/highgui/highgui.hpp>
#include  <opencv2/imgproc/imgproc.hpp>
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
    Point center = Point(src.cols / 2, src.rows / 2);
    double scale = 1;
    rotMat = getRotationMatrix2D(center, angle, scale);
    Mat dst = Mat(src.cols, src.rows, src.type(), Scalar(255, 255, 255));;
    warpAffine(src, dst, rotMat, src.size(), INTER_LINEAR, BORDER_CONSTANT, Scalar(255, 255, 255));
    return imwrite(address, dst);
}




int main(int argc, char** argv)
{
    if(argc!=3)
    {
        exit(0);
    }
    
    string address = argv[1];
    double ang = atof(argv[2]);
    int num=0;
    double ang1=-ang;
    if(rotatesub(address, ang1))
    {
        num=1;
        cout<<num<<endl;
    }
    else
    {
        cout<<num<<endl;
    }
    
    return 0;
}



