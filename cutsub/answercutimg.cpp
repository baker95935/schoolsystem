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

bool recut03sub(double x, double y, double width, double height, string src, string newsrc)
{
    Mat img = cv::imread(src);
    std::stringstream s;
    std::string str1;
    Mat  dst_1 = img(Rect(x, y, width, height));
    return imwrite(newsrc, dst_1);
}


int main(int argc, char** argv)
{
    if(argc!=7)
    {
        exit(0);
    }
    
    double   x = atof(argv[1]);
    double   y = atof(argv[2]);
    double   width = atof(argv[3]);
    double   height = atof(argv[4]);
    string  src = argv[5];
    string  newsrc = argv[6];
    
    
    
    int sum=0;
    if(recut03sub(x,y,width,height, src, newsrc))
    {
        sum=1;
        printf("%d", sum);
    }
    else{
        printf("%d", sum);
    }
    return 0;
}



