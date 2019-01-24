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

bool recut03sub(double y, double height, string src, string newsrc)
{
    Mat img = cv::imread(src);
    std::stringstream s;
    std::string str1;
    Mat  dst_1 = img(Rect(0, y, img.cols, height));
    return imwrite(newsrc, dst_1);
}


int main(int argc, char** argv)
{
    if(argc!=5)
    {
        exit(0);
     }

    double   y = atof(argv[1]);
    double   height = atof(argv[2]);
    string  src = argv[3];
    string  newsrc = argv[4];
    int sum=0;
    if(recut03sub(y,height, src, newsrc))
    {
        sum=1;
        printf("%d", sum);
    }
    else{
         printf("%d", sum);
    }
    return 0;
}


