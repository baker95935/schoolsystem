#include  <opencv2/highgui/highgui.hpp>
#include  <opencv2/imgproc/imgproc.hpp>
#include  <iostream>
#include  <math.h>
#include  <ctime>
#include  <time.h>
#include  <string>
#include  <vector>

using namespace cv;
using namespace std;


int erasersub(int x, int y, int width, int height, string address, int r, int g, int b)
{
    Mat src = cv::imread(address);
    Mat eraser = Mat(height,width,src.type(), Scalar(b, g, r));
    Mat imageROI = src(Rect(x, y,width,height));
    addWeighted(imageROI, 0, eraser, 1, 0., imageROI);
    imwrite(address, src);
    return 1;
}


int main(int argc, char** argv)
{
   
    
    if(argc!=9)
    {
        
        exit(0);
    }
    Mat src;
    double   x = atof(argv[1]);
    double   y = atof(argv[2]);
    double   width = atof(argv[3]);
    double   height = atof(argv[4]);
    string  address = argv[5];
    src = cv::imread(address);

    int r = atoi(argv[6]);
    int g = atoi(argv[7]);
    int b = atoi(argv[8]);
    
    
    
    erasersub( x, y,  width,  height,  address,  r,  g,  b);
    

    return 0;
}

