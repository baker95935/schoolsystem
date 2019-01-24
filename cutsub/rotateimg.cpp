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


